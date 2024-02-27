<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Year;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryEditor(){
        $years = Year::where('active', TRUE)->get();
        $disciplines = Discipline::where('active', TRUE)->get();
        return view('view.categoryEditor',[
            'years' => $years,
            'disciplines' => $disciplines,
        ]);
    }
}
