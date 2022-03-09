<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $table = "eventos";

    protected $fillable = [
        'id',
        'name',
        'description',
        'decorationPrice',
        'entryPrice',
        'state',
        'startDate',
        'endDate'
    ];

    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'required|min:3',
        'startDate' => 'required|date',
        'endDate' => 'required|date|gt:startDate',
        'state' => 'required|boolean',
    ];

    public $timestamps = true;
}
