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
        'state',
        'image'
    ];



    public static $rules = [
        'name' => "required|min:3|max:250|unique:plates",
        'price' => "required|numeric",
        'idCategory' => "required",
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072'
    ];

    public static $rulesEdit = [
        'name' => "required|min:3|max:250",
        'price' => "required|numeric",
        'idCategory' => "required",
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072'
    ];

    public $timestamps = true;
}
