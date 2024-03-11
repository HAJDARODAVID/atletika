<?php

namespace App\Services;

use Livewire\Wireable;
use App\Models\Athlete;
use App\Models\Competition;
use App\Models\AthleteInComp;

/**
 * Class ApplicationFormService.
 */
class ApplicationFormService implements Wireable
{
    public $message=[];

    public function saveNewApplication($data=NULL){

        $data['comp_id']=4;//OVO OBRISATI
        $competition = Competition::with('getAthletesInComp', 'getAthletesInComp.getAthlete')->find($data['comp_id']);
        //check if competition exists
        if(is_null($competition)){
            $this->message['error']=[
                $data['comp_id'] => 'Natjecanje #' . $data['comp_id'] . ' nepostoji!',
            ];
            return;
        }

        //set up a athlete info array
        $athletes = [];
        foreach ($data['comp'] as $key => $value) {
            if($value['firstName'] != null && $value['lastName'] != null){
                extract($value['info']);
                $athletes[$key] = [
                    'firstName' => $value['firstName'],
                    'lastName' => $value['lastName'],
                    'gender' => $value['gender'] == NULL ? $data['catSelected'] : $value['gender'],
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'zip' => $zip,
                    'athlete_id' => $athlete_id,
                ];
            }
        }

        //check if athletea are in competition 
        $athleteInComp = $competition->getAthletesInComp;
        foreach ($athletes as $athlete) {
            $athleteObj = Athlete::where('athlete_id', $athlete['athlete_id'])->first();
            if(!is_null($athleteObj)){
                if(!is_null($athleteInComp->where('athlete_id', $athleteObj->id)->first())){
                    $athleteInfo = $athleteInComp->where('athlete_id', $athleteObj->id)->first();
                    $this->message['error'][$athleteInfo->getAthlete->id] = 'Za natjecatelja: ' . $athleteInfo->getAthlete->firstName.' '.$athleteInfo->getAthlete->lastName . ' postoji prijavnica za ovo natjecanje!';
                }
            }
        }
        
        //return if error
        if(isset($this->message['error'])){
            return;
        };

        dd('brake');
    }

    public function toLivewire()
    {
        return [
            'message' => $this->message,
        ];
    }
 
    public static function fromLivewire($value)
    {
    }

}
