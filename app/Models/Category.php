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
<<<<<<< HEAD
        'name' => 'required|string|unique:categories|min:3|max:50',
=======
        'name' => 'required|unique:categories|min:3|max:50|alpha_num',
    ];

    public static $rulesEdit = [
        'name' => 'required|min:3|max:250|alpha_num',
>>>>>>> 0d43536de06425a0ed5a2430b73a4f7ce2c5a93c
    ];

    public $timestamps = false;
}
