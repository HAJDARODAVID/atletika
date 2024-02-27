<?php

namespace App\Livewire;

use Livewire\Component;

class SetDisciplineAndYear extends Component
{
    public $years;
    public $disciplines;

    public function render()
    {
        return view('livewire.set-discipline-and-year');
    }
}
