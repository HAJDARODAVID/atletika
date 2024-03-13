<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    const PRIORITY_HIGH   = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_LOW    = 3;

    const PRIORITY = [
        self::PRIORITY_HIGH   => 'Visoko',
        self::PRIORITY_MEDIUM => 'Srednje',
        self::PRIORITY_LOW    => 'Nisko',
    ];

    const TICKET_STATUS_INITIALIZED   = 1;
    const TICKET_STATUS_CANCELED      = -1;
    const TICKET_STATUS_WIP           = 5;
    const TICKET_STATUS_IN_PRODUCTION = 10;

    const TICKET_STATUS = [
        self::TICKET_STATUS_INITIALIZED   => 'Inicializiran',
        self::TICKET_STATUS_CANCELED      => 'Storno',
        self::TICKET_STATUS_WIP           => 'U izradi',
        self::TICKET_STATUS_IN_PRODUCTION => 'Prebačeno na P',
    ];

    protected $table = 'tickets';

    protected $fillable = [
        'name', 
        'body', 
        'priority', 
        'status'
    ];
}
