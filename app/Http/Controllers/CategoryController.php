<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Dsply;
use App\Models\Year;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryEditor(){
        $years = Year::where('active', TRUE)->get();
        $disciplines = Discipline::where('active', TRUE)->get();
        $dsply = Dsply::get();
        return view('view.categoryEditor',[
            'years' => $years,
            'disciplines' => $disciplines,
            'dsply' => $dsply,
        ]);
    }

    public function addNewYear(Request $request){
        if($request['year'] == ""){
            return redirect()->route('categoryEditor');
        }
        $year = Year::where('year', $request['year'])->first();
        if(is_null($year)){
            Year::create([
                'year' => $request['year'],
                'active' => TRUE,
            ]);
            return redirect()->route('categoryEditor');
        }

        if(!is_null($year)){
            $year->update([
                'active' => TRUE,
            ]);
            return redirect()->route('categoryEditor');
        }
    }

    public function addNewDiscipline(Request $request){
        if($request['name'] == ""){
            return redirect()->route('categoryEditor');
        }
        $dspl = Discipline::where('name', $request['name'])->first();
        if(is_null($dspl)){
            Discipline::create([
                'name' => $request['name'],
                'type' => 1,
                'active' => TRUE,
            ]);
            return redirect()->route('categoryEditor');
        }

        if(!is_null($dspl)){
            $dspl->update([
                'active' => TRUE,
            ]);
            return redirect()->route('categoryEditor');
        }

    }
}
