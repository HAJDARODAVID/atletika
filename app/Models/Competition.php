<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    use HasFactory;

    protected $table = 'competitions';

    protected $fillable =[
        'name', 
        'organizer', 
        'place',
        'remark',
        'from',
        'to',
        'status',
    ];

    /**
     * Get all athletes in competition.
     */
    public function getAthletesInComp(): HasMany
    {
        return $this->hasMany(AthleteInComp::class, 'comp_id', 'id');
    }

}
