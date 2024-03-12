<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationForm extends Model
{
    use HasFactory;

    protected $table = 'application_forms';

    protected $fillable =[
        'user_id', 
        'comp_id', 
        'team_name', 
        'year', 
        'category',
    ];

    public function getAthletesFromApplication(): HasMany
    {
        return $this->hasMany(AthleteInComp::class, 'app_id', 'id');
    }
}
