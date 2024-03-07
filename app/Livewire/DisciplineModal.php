<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class DisciplineModal extends Component
{
    public $athlete;
    public $disciplines;
    public $modalShowStatus = 'none';
    public $isComplete      = 'danger';
    public $dsplCount            = [];
    public $dsplArray;

    public function mount(){
        $this->dsplCount = [
            1 => 0,
            2 => 0
        ]; 
    }
    public function changeModalStatus($status=0){
        if($status){
            return $this->modalShowStatus = 'block';
        }
        if(!$status){
            $this->dispatch('setUpDisciplinesForAthlete', $this->athlete, $this->dsplArray);
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
    }

    public function test(){
        dd($this->dsplArray, $this->dsplCount);
    }


    public function render()
    {
        return view('livewire.discipline-modal');
    }
}
