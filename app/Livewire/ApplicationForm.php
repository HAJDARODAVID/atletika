<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Discipline;
use App\Models\Dsply;
use App\Models\Year;
use Livewire\Component;
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
    public $genderCount;
    public $discipline = NULL;
    public $dsplArray  = [];
    public $showModal  = 'none';

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
    }

    public function test(){
        dd($this->discipline);
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
                    'gender'    => 0,
                    'dspl'    => 0,
                ];
            }
            return $array;
       }
    }

    public function render()
    {
        return view('livewire.application-form');
    }
}
