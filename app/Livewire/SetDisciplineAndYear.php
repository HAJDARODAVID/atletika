<?php

namespace App\Livewire;

use App\Models\Dsply;
use Livewire\Component;

class SetDisciplineAndYear extends Component
{
    public $years;
    public $disciplines;
    public $dataCB;
    public $dsply;

    public function mount(){
        $this->setDataCheckBox(); //Set the dataCB array keys and value
    }

    public function updatedDataCB($key, $value){
        $entry=$this->dsply->where('id', $value)->first();
        if ($key) {
            if(is_null($entry)){
                Dsply::create([
                    'id' => $value,
                    'year_id' =>substr($value, -4),
                    'dspl_id' =>substr($value, 0,4),
                ]);
            }
        }
        if (!$key) {
            if(!is_null($entry)){
                $entry->delete();
            }
        }    
    }

    public function deactivateYear($year){
        $year = $this->years->where('year', $year['year'])->first();
        $dsply = Dsply::where('year_id',$year['year'])->get();
        foreach ($dsply as $dspl) {
            $dspl->delete();
        }
        $year->update([
            'active' => FALSE,
        ]);
        return redirect()->route('categoryEditor');
    }

    public function deactivateDspl($dspl){
        $dspl = $this->disciplines->where('id', $dspl['id'])->first();
        $dsply = Dsply::where('dspl_id',$dspl['id'])->get();
        foreach ($dsply as $dp) {
            $dp->delete();
        }
        $dspl->update([
            'active' => FALSE,
        ]);
        return redirect()->route('categoryEditor');
    }

    public function render()
    {
        return view('livewire.set-discipline-and-year');
    }

    private function setDataCheckBox(){
        foreach ($this->disciplines as $dspl) {
            foreach ($this->years as $year) {
                $key=$dspl->id .'_'. $year->year;
                $entry=$this->dsply->where('id', $key)->first();
                if(!is_null($entry)){
                    $this->dataCB[$key] = TRUE;
                }else{
                    $this->dataCB[$key] = FALSE;
                }
                
            }
        }
        return;
    }
}
