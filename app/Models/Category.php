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
    ];

    public static $rules = [
        'name' => 'required|min:3|max:50',
    ];

    public $timestamps = false;
}
