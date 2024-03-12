<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Athlete extends Model
{
    use HasFactory;

    protected $table = 'athlete';

    protected $fillable = [
        'firstName', 
        'lastName', 
        'gender', 
        'address', 
        'city', 
        'state', 
        'zip', 
        'athlete_id'
    ];

    public function getGender(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'gender');
    }
}
