<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $table='disciplines';
    public $timestamps = false;

    protected $fillable =[
        'name', 
        'type', 
        'active',
    ];
}
