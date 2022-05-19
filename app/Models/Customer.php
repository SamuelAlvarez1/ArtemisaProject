<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = [
        'id',
        'document',
        'name',
        'idUser',
        'address',
        'phoneNumber',
        'state',
        'created_at',
        'updated_at'
    ];

    public static $rules = [
        'name' => 'required|min:5|max:50|regex:/^[a-zA-ZÀ-ÿñÑ ]+$/',
        'document' => 'required|numeric|digits_between:6,15|unique:customers',
        'address' => 'required|min:5|max:70',
        'phoneNumber' => 'required|min:7|max:13',
    ];
    public static $rulesUpdate = [
        'name' => 'required|min:5|max:50|regex:/^[a-zA-ZÀ-ÿñÑ ]+$/',
        'document' => 'required|digits_between:6,15',
        'address' => 'required|min:5|max:70',
        'phoneNumber' => 'required|min:7|max:20',
    ];

    public $timestamps = true;
}
