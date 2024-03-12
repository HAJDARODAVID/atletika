<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AthleteDspl extends Model
{
    use HasFactory;

    protected $table = 'athlete_dspl';
    public $timestamps = false;

    protected $fillable =[
        'aic_id', 
        'dspl_id', 
    ];

    public function getDisciplineInfo(): HasOne
    {
        return $this->hasOne(Discipline::class, 'id', 'dspl_id');
    }


}
