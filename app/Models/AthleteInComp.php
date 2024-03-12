<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AthleteInComp extends Model
{
    use HasFactory;

    protected $table = 'athlete_in_comps';

    protected $fillable = [
        'comp_id',
        'app_id',
        'athlete_id',
    ];

    /**
     * Get athlete.
     */
    public function getAthlete(): HasOne
    {
        return $this->hasOne(Athlete::class, 'id', 'athlete_id');
    }

     /**
     * Get discipline.
     */
    public function getDisciplines(): HasMany
    {
        return $this->hasMany(AthleteDspl::class, 'aic_id', 'id');
    }

}
