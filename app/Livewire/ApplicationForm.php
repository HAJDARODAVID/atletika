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
    public $catSelected  = 0;
    public $yearSelected = 0;
    public $maxComp      = 4;
    public $ratio        = 2;
    public $comp;
    public $genderCount;


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
        dd($this->comp);
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
