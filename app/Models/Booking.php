<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = "bookings";

    protected $fillable = [
        'id',
        'idCustomer',
        'idUser',
        'idEvent',
        'amount_people',
        'state',
        'start_date',
        'final_date',
    ];

    protected $dates = [
        'start_date',
        'final_date',
    ];

    public $timestamps = true;
}
