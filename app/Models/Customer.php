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
        'name' => 'required|min:4|max:50|regex:/^[a-zA-ZÀ-ÿñÑ ]+$/',
        'document' => 'required|numeric|digits_between:6,15|unique:customers|starts_with:1,2,3,4,5,6,7,8,9',
        'address' => 'required|min:5|max:70',
        'phoneNumber' => 'required|min:7|max:13',
    ];
    public static $rulesUpdate = [
        'name' => 'required|min:5|max:50|regex:/^[a-zA-ZÀ-ÿñÑ ]+$/',
        'document' => 'required|digits_between:6,15',
        'address' => 'required|min:5|max:70',
        'phoneNumber' => 'required|min:7|max:20',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public $timestamps = true;
}
