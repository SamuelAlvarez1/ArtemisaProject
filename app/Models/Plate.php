<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    use HasFactory;

    protected $table = "plates";

    protected $fillable = [
        'id',
        'name',
        'basePrice',
        'idCategory',
        'state'
    ];

    public static $rules = [
        'name' => "required|min:3",
        'basePrice' => "required",
        'idCategory' => "required",
        'state' => "required"
    ];

    public $timestamps = true;
}
