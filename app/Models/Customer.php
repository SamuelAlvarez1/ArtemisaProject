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
        'address',
        'phoneNumber',
        'state',
    ];

    public static $rules = [
        'name' => 'required|min:5|max:50',
        'document' => 'required|min:8|max:11|unique:customers',
        'address' => 'required',
        'phoneNumber' => 'required',
        'state' => 'required|boolean',
    ];
    public static $rulesUpdate = [
        'name' => 'required|min:5|max:50',
        'document' => 'required|min:8|max:11',
        'address' => 'required',
        'phoneNumber' => 'required',
        'state' => 'required|boolean',
    ];

    public $timestamps = false;
}
