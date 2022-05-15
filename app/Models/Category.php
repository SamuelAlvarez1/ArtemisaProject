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
        'name' => 'required|string|unique:categories|min:3|max:50',
    ];

    public $timestamps = false;
}
