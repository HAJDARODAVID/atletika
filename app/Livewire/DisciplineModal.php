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
    public $dspl            = [];

    public function mount(){
        dd($this->dspl); 
    }
    public function changeModalStatus($status=0){
        if($status){
            return $this->modalShowStatus = 'block';
        }
        if(!$status){
            return $this->modalShowStatus = 'none';
        }
    }

    public function updatedDspl($key, $value){
        $this->dspl[$value] = $key;
    }

    public function render()
    {
        return view('livewire.discipline-modal');
    }
}
