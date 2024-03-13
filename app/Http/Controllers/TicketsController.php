<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function tickets(){
        return view('view.tickets', [
            'priorities' => Ticket::PRIORITY,
        ]);
    }

    public function newTickets(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'body' => 'required'
        ]);

        Ticket::create($request->all());
        return redirect()->route('tickets')->with('success', 'Novi ticket uspješno kreiran!');
    }
}
