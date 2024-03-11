<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
