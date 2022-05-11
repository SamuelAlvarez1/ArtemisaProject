<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookingState extends Model
{
    use HasFactory;

    protected $table = "bookings_states";

    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;
}
