<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
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
        'document' => 'required|unique:customers|min:8|max:11',
        'address' => 'required',
        'phoneNumber' => 'required',
        'state' => 'required|boolean',
    ];

    public $timestamps = false;
}
