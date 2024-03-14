<?php

namespace App\Livewire;

use App\Models\Year;
use App\Models\Dsply;
use Livewire\Component;
use App\Models\Category;
use App\Models\Discipline;
use App\Services\ApplicationFormService;
use Livewire\Attributes\On; 

class ApplicationForm extends Component
{
    public $cat;
    public $mixCat;
    public $years;
    public $catSelected  = 0;
    public $yearSelected = 0;
    public $maxComp      = 4;
    public $ratio        = 2;
    public $comp;
    public $compId;
    public $genderCount;
    public $discipline = NULL;
    public $dsplArray  = [];
    public $showModal  = 'none';
    public $teamName;
    public $error=[];
    public $updateData = NULL;
    public $oldAppId = NULL;

    #[On('refreshComponent')] 
    public function mount(){
        $this->cat    = Category::where('active',TRUE)->get();
        $this->years  = Year::where('active',TRUE)->get();
        $this->mixCat = $this->setMixCat();
        $this->comp   = $this->setCompArray();
        $this->genderCount=[
            1 => 0,
            2 => 0,
        ];
        $this->fillInDataIfEditMode();
    }

    public function test(){
        dd($this->comp);
    }

    #[On('setUpDisciplinesForAthlete')]
    public function setAthleteDisciplines($athlete, $dspl){
        return $this->comp[$athlete]['dspl']=$dspl;
    } 

    #[On('setInfoForAthlete')]
    public function setInfoForAthlete($athlete, $info){
        return $this->comp[$athlete]['info']=$info;
    } 

    public function modal($type){
        if($type){
            return $this->showModal='block';
        }
        if(!$type){
            return $this->showModal='none';
        }
    }

    public function updatedComp($key, $value){
        list($competitor, $arrayKey) = explode(".", $value);
        if($arrayKey=='gender'){
            $this->genderCount=[
                1 => 0,
                2 => 0,
            ];
            foreach ($this->comp as $key => $value) {
                if($value['gender']){
                    $this->genderCount[$value['gender']]++;
                }
            }
        }
    }

    public function updatedYearSelected(){
        $dspy=Dsply::where('year_id', $this->yearSelected)
            ->pluck('dspl_id')->toArray();
        $dspl=Discipline::whereIn('id', $dspy)->get();
        $this->discipline = $dspl;  
        foreach ($dspl as $dsp) {
            $this->dsplArray[$dsp->id]=FALSE; 
        } 
        for ($i=1; $i <= $this->maxComp; $i++) { 
            $this->comp[$i]['dspl']=NULL;
        }
    }

    public function saveApplication(){
        unset($this->error['message']); 
        $data = $this->validateData();
        if($data['errorCount']){
            return;
        }
        $data['data']['compId'] = $this->compId;
        if($data['errorCount'] == 0){
            $service = new ApplicationFormService;
            $service->saveNewApplication($data['data'],$this->oldAppId);
            if(isset($service->message['error'])){
                $this->error['message'] = $service->message['error'];
                return;
            }
            if(isset($service->message['success'])){
                return redirect()->route('myHome')->with('success', 'Nova prijavnica uspješno kreirana!');
            }
        }
    }

    private function setMixCat($trigger=null){
        return $this->cat->where('name', '!=', 'MIX');
    }

    private function setCompArray(){
       if(is_null($this->comp)){
            $array=[];
            for ($i=1; $i <= $this->maxComp; $i++) { 
                $array[$i]=[
                    'firstName' => NULL,
                    'lastName'  => NULL,
                    'gender'    => NULL,
                    'dspl'    => NULL,
                    'info' => [
                        'address' => NULL,
                        'city' => NULL,
                        'state' => NULL,
                        'zip' => NULL,
                        'athlete_id' => NULL,
                    ]
                ];
            }
            return $array;
       }
    }

    private function validateData(){
        $data=[
            'message' => NULL,
            'errorCount' => NULL,
            'data' => NULL,
        ];
        $errorCount=0;
        $this->error=[];

        //Check if team name is set
        if(!$this->teamName){
            $this->error['teamName']=TRUE;
            $errorCount++;
        }
        //Check if year is set
        if($this->yearSelected == 0){
            $this->error['yearSelected']=TRUE;
            $errorCount++;
        }
        //Check if category is set
        if($this->catSelected == 0){
            $this->error['catSelected']=TRUE;
            $errorCount++;
        }

        $athleteCount = 0;
        foreach ($this->comp as $key => $value) {
            if($this->comp[$key]['firstName'] || $this->comp[$key]['lastName']){
                $athleteCount++;
                if(!$this->comp[$key]['firstName']){
                    $this->error[$key]['firstName']=TRUE;
                    $errorCount++;
                }
                if(!$this->comp[$key]['lastName']){
                    $this->error[$key]['lastName']=TRUE;
                    $errorCount++;
                }
                $infoCount=0;
                foreach ($this->comp[$key]['info'] as $info) {
                    if($info){
                        $infoCount++;
                    }
                }
                if($infoCount != count($this->comp[$key]['info'])){
                    $this->error[$key]['row']=TRUE;
                    $errorCount++;
                }
                if($this->comp[$key]['dspl'] != NULL){
                    $dspCount=$this->dsplCount($this->comp[$key]['dspl']);
                    if($dspCount[1] < 2 && $dspCount[1] < 2){
                        $this->error[$key]['row']=TRUE;
                        $errorCount++;
                    }
                }else{
                    $this->error[$key]['row']=TRUE;
                    $errorCount++;
                }                
            }
        }
        if(!$athleteCount){
            $this->error[1]['row']=TRUE;
            $errorCount++;
        }
        $data['errorCount'] = $errorCount;
        $data['data']=[
            'teamName' => $this->teamName,
            'yearSelected' => $this->yearSelected,
            'catSelected' => $this->catSelected,
            'comp' => $this->comp,
        ];
        return $data;        
    }

    private function dsplCount($array){
        $finalArray = [
            1 => 0,
            2 => 0
        ];
        foreach ($array as $key => $value) {
            if ($value) {
                $type = $this->discipline->where('id', $key)->first()->type;
                $finalArray[$type]++;
            }
        }
        return $finalArray;
    }

    private function fillInDataIfEditMode(){
        if($this->updateData != NULL){
            dd($this->updateData);
            $this->comp = $this->updateData['comp'];
            $this->catSelected  = $this->updateData['catSelected'];
            $this->yearSelected = $this->updateData['yearSelected'];
            $this->teamName = $this->updateData['teamName'];
            $dspy=Dsply::where('year_id', $this->yearSelected)
                ->pluck('dspl_id')->toArray();
            $dspl=Discipline::whereIn('id', $dspy)->get();
            $this->discipline = $dspl;
            
        }
    }

    public function render()
    {
        return view('livewire.application-form');
    }
}
