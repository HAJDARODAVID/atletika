<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function competitions(){
        return view('view.competitions');
    }

    public function competition($id){
        $competition = Competition::find($id);
        return view('view.competition',[
            'competition' => $competition,
        ]);
    }
}
