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
        if(date('Y-m-d') >=  $compObj->from && date('Y-m-d') <=  $compObj->to){
            return view('application',[
                'compObj' => $compObj,
            ]);
        }
        return redirect()->route('myHome');   
    }

    public function showApplication($id){

        $appForm= ApplicationForm::where('id', $id)
                    ->with(
                        'getAthletesFromApplication',
                        'getCompetitionInfo',
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
