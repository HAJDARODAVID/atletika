<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

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
}
