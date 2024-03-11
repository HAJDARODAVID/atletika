<?php

namespace App\Services;

use App\Models\Competition;

/**
 * Class CompetitionService.
 */
class CompetitionService
{
    public function createNewCompetition($data){
        $data['status'] = 1;
        $newComp = Competition::create($data);
        return redirect()->route('competitions')->with('success', 'Natjecanje #' .$newComp->id. ' uspješno kreirano!');
    }
}
