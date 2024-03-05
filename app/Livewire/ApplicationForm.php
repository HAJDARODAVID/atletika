<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Year;
use Livewire\Component;
use Livewire\Attributes\On; 

class ApplicationForm extends Component
{
    public $cat;
    public $mixCat;
    public $years;
    public $catSelected=0;

    #[On('refreshComponent')] 
    public function mount(){
        $this->cat=Category::where('active',TRUE)->get();
        $this->years=Year::where('active',TRUE)->get();
        $this->mixCat=$this->setMixCat();
    }

    public function updatedCatSelected(){
        $this->dispatch('refreshComponent')->self();    
    }

    private function setMixCat(){
        return $this->cat->where('name', '!=', 'MIX');
    }

    public function render()
    {
        return view('livewire.application-form');
    }
}
