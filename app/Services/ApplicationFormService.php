<?php

namespace App\Services;

use App\Models\Dsply;
use Livewire\Wireable;
use App\Models\Athlete;
use App\Models\AthleteDspl;
use App\Models\Competition;
use App\Models\AthleteInComp;
use App\Models\ApplicationForm;
use Illuminate\Support\Facades\Auth;

/**
 * Class ApplicationFormService.
 */
class ApplicationFormService implements Wireable
{
    public $message=[];

    public function saveNewApplication($data=NULL, $oldAppId=NULL){
        
        $competition = Competition::with('getAthletesInComp', 'getAthletesInComp.getAthlete')->find($data['compId']);
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
                    'firstName'  => $value['firstName'],
                    'lastName'   => $value['lastName'],
                    'gender'     => $value['gender'] == NULL ? $data['catSelected'] : $value['gender'],
                    'address'    => $address,
                    'city'       => $city,
                    'state'      => $state,
                    'zip'        => $zip,
                    'athlete_id' => $athlete_id,
                ];
            }
        }

        /**
         * Delete old application if $oldAppId != NULL
         * This will happen when a user needs to change existing app-form 
         * Also this will jump over the 'check if athletes are in competition' because, well, we deleted them
         */
        if($oldAppId){
            ApplicationForm::find($oldAppId)->delete(); 
            goto jumpOverCheckIfInCompetition;
        }
        
        //check if athletes are in competition 
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

        jumpOverCheckIfInCompetition:
        //create a new application form entry
        $newApplication = ApplicationForm::create([
            'user_id'   => Auth::user()->id,
            'comp_id'   => $data['compId'],
            'team_name' => $data['teamName'],
            'year'      => $data['yearSelected'],
            'category'  => $data['catSelected'],
        ]);

        //create new athlete or update existing, then add to competition
        $dspList=$data['comp'];
        foreach ($athletes as $key => $athlete) {
            //check if athlete exists
            $athleteObj = Athlete::where('athlete_id', $athlete['athlete_id'])->first();
            if(!is_null($athleteObj)){
                $athleteObj->update($athlete);            
            }else{
                $athleteObj = Athlete::create($athlete);
            }
            //add athlete to competition
            $aic = AthleteInComp::create([
                'comp_id'    => $data['compId'],
                'app_id'     => $newApplication->id,
                'athlete_id' => $athleteObj->id
            ]);
            foreach($dspList[$key]['dspl'] as $dsp_id => $isTrue){
                if($isTrue){
                    AthleteDspl::create([
                        'aic_id'  => $aic->id,
                        'dspl_id' => $dsp_id,
                    ]);
                }
            }
        }
        
        return $this->message['success'] = TRUE;
    }

    public function getArrayForApplication($comp){
        $data['compId'] = $comp->comp_id;
        $data['teamName'] = $comp->team_name;
        $data['yearSelected'] = $comp->year;
        $data['catSelected'] = $comp->category;

        $dspy=Dsply::where('year_id', $comp->year)
            ->pluck('dspl_id')->toArray();

        $i=1;  
        foreach ($comp->getAthletesFromApplication as $athlete) {
            $data['comp'][$i]=[
                'firstName' => $athlete->getAthlete->firstName,
                'lastName'  => $athlete->getAthlete->lastName,
                'gender'    => $athlete->getAthlete->gender,
            ];
            $data['comp'][$i]['info']=[
                'address'    => $athlete->getAthlete->address,
                'city'       => $athlete->getAthlete->city,
                'state'      => $athlete->getAthlete->state,
                'zip'        => $athlete->getAthlete->zip,
                'athlete_id' => $athlete->getAthlete->athlete_id,
            ];
            foreach ($dspy as $dsp) {
                $data['comp'][$i]['dspl'][$dsp] = $athlete->getDisciplines->where('dspl_id', $dsp)->first() == NULL ? FALSE : TRUE;
            }
            $i++;
        }
        
        return $data;
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
