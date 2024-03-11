<?php

namespace App\Livewire;

use App\Models\Competition;
use Livewire\Component;

class UpdateCompetitionBtn extends Component
{
    public $type;
    public $newStatus;
    public $competition;

    public function mount(){
        $this->newStatus =$this->setNewStatus();
    }

    public function update(){
        $this->competition->update([
            'status' => $this->newStatus
        ]);
        return redirect()->route('competitions');
    }

    private function setNewStatus(){
        if($this->type == 'delete'){
            return $this->newStatus = Competition::COMP_STATUS_INACTIVE;
        }
        if($this->type == 'finished'){
            return $this->newStatus = Competition::COMP_STATUS_DONE;
        }
    }

    public function render()
    {
        return view('livewire.update-competition-btn');
    }
}
