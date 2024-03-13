<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    const COMP_STATUS_INACTIVE = -1;
    const COMP_STATUS_ACTIVE = 1;
    const COMP_STATUS_DONE = 2;

    const COMP_STATUS = [
        self::COMP_STATUS_INACTIVE  => 'Deaktivirano',
        self::COMP_STATUS_ACTIVE  => 'Aktivno',
        self::COMP_STATUS_DONE  => 'Završeno',
    ];

    use HasFactory;

    protected $table = 'competitions';

    protected $fillable =[
        'name', 
        'organizer', 
        'place',
        'remark',
        'from',
        'to',
        'event_date',
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
