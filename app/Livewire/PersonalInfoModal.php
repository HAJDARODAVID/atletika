<?php

namespace App\Livewire;

use App\Models\State;
use Livewire\Component;

class PersonalInfoModal extends Component
{
    public $modalShowStatus = 'none';
    public $isComplete;
    public $comp;
    public $info;
    public $athlete;
    public $athleteName;
    public $error = [];
    public $state;

    public function mount(){
        $this->info = $this->comp[$this->athlete]['info'];
        $this->state = State::get();
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
        unset($this->error[$value.'is-in-app']);
        if($value != ""){
            $this->error[$value] = FALSE;
        }else{
            $this->error[$value] = TRUE;
        }
        if($value=='athlete_id'){
            if($this->checkIfAthleteIsInApplication($key)){
                $this->error[$value] = TRUE;
                $this->error[$value.'is-in-app'] = TRUE;
                $this->info[$value] = NULL;
            }
        }
        if($value=='zip'){
            if(!is_int($key)){
                $this->error[$value] = TRUE;
                $this->info[$value] = NULL;
            }
        }
    }

    private function checkIfAthleteIsInApplication($athleteId = NULL){    
        foreach ($this->comp as $key => $value) {
            if($key != $this->athlete && $value['info']['athlete_id'] == $athleteId){
                return TRUE;
            }
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
