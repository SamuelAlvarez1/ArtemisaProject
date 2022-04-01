<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "events";

    protected $fillable = [
        'id',
        'name',
        'description',
        'decorationPrice',
        'entryPrice',
        'state',
        'startDate',
        'endDate',
        'image'
    ];

    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'required|min:3',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'state' => 'required|boolean',
    ];

    public $timestamps = true;
}
