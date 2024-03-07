<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class DisciplineModal extends Component
{
    public $athlete;
    public $disciplines;
    public $modalShowStatus = 'none';
    public $isComplete;
    public $dsplCount            = [];
    public $dsplArray;

    public function mount(){
        $this->checkIfComplete();
        $this->dsplCount = [
            1 => 0,
            2 => 0
        ]; 
    }
    public function changeModalStatus($status=0){
        if($status){
            $this->dsplCount = $this->dsplCount($this->dsplArray);
            //$this->checkIfComplete();
            return $this->modalShowStatus = 'block';
        }
        if(!$status){
            $this->dispatch('setUpDisciplinesForAthlete', $this->athlete, $this->dsplArray);
            //$this->checkIfComplete();
            return $this->modalShowStatus = 'none';
        }
    }

    public function updatedDsplArray($key, $value){
        $type = $this->disciplines->where('id', $value)->first()->type;
        if($key){
            $this->dsplCount[$type]++;
        }
        if(!$key){
            $this->dsplCount[$type]--;
        }
        //$this->checkIfComplete();
    }

    private function dsplCount($array){
        $finalArray = [
            1 => 0,
            2 => 0
        ];
        foreach ($array as $key => $value) {
            if ($value) {
                $type = $this->disciplines->where('id', $key)->first()->type;
                $finalArray[$type]++;
            }
        }
        return $finalArray;
    }

    private function checkIfComplete(){
        $arraySum = array_sum($this->dsplCount($this->dsplArray));
        if($arraySum >= 4){
            return $this->isComplete = 'success';
        }else{
            return $this->isComplete = 'danger';
        }
    }


    public function render()
    {
        return view('livewire.discipline-modal');
    }
}
