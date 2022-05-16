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


=======
>>>>>>> 3a18fed52fb091bf56a44ba224ecb11d81793368
        'name' => 'required|unique:categories|min:3|max:50|alpha_num',
    ];

    public static $rulesEdit = [
        'name' => 'required|min:3|max:250|alpha_num',
    ];

    public $timestamps = false;
}
