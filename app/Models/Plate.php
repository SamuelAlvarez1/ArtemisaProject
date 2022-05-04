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
        'price',
        'idCategory',
        'state'
    ];

 

    public static $rulesEdit = [
        'name' => "required|min:3",
        'price' => "required|numeric",
        'idCategory' => "required"
    ];

    public $timestamps = true;
}
