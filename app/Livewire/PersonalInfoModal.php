<?php

namespace App\Livewire;

use Livewire\Component;

class PersonalInfoModal extends Component
{
    public $modalShowStatus = 'none';
    public $isComplete;
    public $info;
    public $athlete;
    public $athleteName;
    public $error = [];

    public function mount(){
        $this->checkIfComplete();
        $this->checkIfAllIsEmpty();
    }

    public function changeModalStatus($status=0){
        if($status){
            return $this->modalShowStatus = 'block';
        }
        if(!$status){
            $this->dispatch('setInfoForAthlete', $this->athlete, $this->info)->to(ApplicationForm::class);
            return $this->modalShowStatus = 'none';
        }
    }

    public function updatedInfo($key, $value){
        if($value != ""){
            $this->error[$value] = FALSE;
        }else{
            $this->error[$value] = TRUE;
        }
    }

    private function checkIfComplete(){
        $this->setError();
        foreach ($this->info as $key => $value) {
            if(!$value){
                return $this->isComplete = 'danger';
            }
        }
        return $this->isComplete = 'success';
    }

    private function checkIfAllIsEmpty(){
        $i=0;
        foreach ($this->info as $key => $value) {
            if(!$value){
                $i++;
            }
        }
        if($i == count($this->info)){
            foreach ($this->info as $key => $value) {
                $this->error[$key] = FALSE;
            }
        }
        return;
    }

    private function setError(){
        foreach ($this->info as $key => $value) {
            $this->error[$key] = $value == NULL ? TRUE : FALSE;
        }
        return;
    }

    public function render()
    {
        return view('livewire.personal-info-modal');
    }
}
