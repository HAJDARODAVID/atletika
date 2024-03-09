<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
