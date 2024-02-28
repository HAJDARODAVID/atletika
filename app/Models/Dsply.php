<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dsply extends Model
{
    use HasFactory;

    protected $table = 'dspl_for_year';

    protected $primaryKey = 'id';
    public $incrementing = false; 

    protected $fillable = [
        'id',
        'year_id',
        'dspl_id',
    ];

    public $timestamps = false;
}
