<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'id',
        'name',
        'state',
        'idUser',
    ];

    public static $rules = [
        'name' => 'required|unique:categories|min:3|max:50|regex:/^[a-zA-ZÀ-ÿñÑ0-9 ]+$/',
    ];

    public static $rulesEdit = [
        'name' => 'required|min:3|max:250|regex:/^[a-zA-ZÀ-ÿñÑ0-9 ]+$/',
    ];

    public $timestamps = false;
}
