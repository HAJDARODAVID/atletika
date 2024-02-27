<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $table = 'years';

    protected $primaryKey = 'year';
    public $incrementing = false; 

    protected $fillable = [
        'year',
        'active',
    ];

    protected $attributes = [
        'active' => true,
    ];

    public $timestamps = false;

}
