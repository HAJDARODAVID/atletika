<?php

namespace App\Livewire;

use App\Services\CompetitionService;
use Livewire\Component;

class CreateNewCompetitionModal extends Component
{
    public $modalShowStatus = 'none';
    public $compInfo=[];
    public $error = [];

    public function mount(){
        $this->checkIfAllIsEmpty();
    }

    public function changeModalStatus($status=0){
        if($status){
            return $this->modalShowStatus = 'block';
        }
        if(!$status){
            $this->compInfo=[];
            $this->error=[];
            return $this->modalShowStatus = 'none';
        }
    }

    public function save(){
        if($this->dataValidation()) {
            $service = new CompetitionService;
            return $service->createNewCompetition($this->compInfo);
        };
    }

    private function dataValidation(){
        $this->error=[];
        $keyArray=['name', 'organizer', 'place', 'remark', 'from', 'to', 'event_date'];
        $isComplete = TRUE;
        foreach ($keyArray as $key){
            if(!array_key_exists($key, $this->compInfo)){
                $isComplete = FALSE;
                $this->error[$key] = TRUE;
            }
        }
        return $isComplete;
    }

    private function checkIfAllIsEmpty(){
        $i=0;
        foreach ($this->compInfo as $key => $value) {
            if(!$value){
                $i++;
            }
        }
        if($i == count($this->compInfo)){
            foreach ($this->compInfo as $key => $value) {
                $this->error[$key] = FALSE;
            }
        }
        return;
    }

    private function setError(){
        foreach ($this->compInfo as $key => $value) {
            $this->error[$key] = $value == NULL ? TRUE : FALSE;
        }
        return;
    }

    public function render()
    {
        return view('livewire.create-new-competition-modal');
    }
}
