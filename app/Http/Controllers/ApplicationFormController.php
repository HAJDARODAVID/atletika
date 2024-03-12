<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\ApplicationForm;

class ApplicationFormController extends Controller
{
    public function application($competition){
        $compObj = Competition::find($competition);
        if($compObj->status != 1){
            return redirect()->route('myHome');
        }
        return view('application',[
            'compObj' => $compObj,
        ]);
    }

    public function showApplication($id){

        $appForm= ApplicationForm::where('id', $id)
                    ->with(
                        'getAthletesFromApplication',
                        'getAthletesFromApplication.getAthlete',
                        'getAthletesFromApplication.getDisciplines',
                        'getAthletesFromApplication.getDisciplines.getDisciplineInfo',
                    )
                    ->first();

        return view('view.showApplication',[
            'appForm' => $appForm,
        ]);

    }
}
