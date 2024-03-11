<?php

namespace App\Livewire;

use Livewire\Component;

class InputBoxChangeData extends Component
{
    public $title;
    public $for;
    public $model;
    public $value;
    public $showSaved='';

    public function mount(){
        $this->value = $this->model->{$this->for};
    }

    public function updatedValue(){
        if($this->value != ""){
            $this->model->update([
                $this->for => $this->value,
            ]);
            return $this->showSaved = 'is-valid';
        }else{
            $this->value = $this->model->{$this->for};
        }
    }

    public function render()
    {
        return view('livewire.input-box-change-data');
    }
}
