<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('view.dashboard');
    }
}
