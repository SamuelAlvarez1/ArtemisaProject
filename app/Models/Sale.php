<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = "sales";

    protected $fillable = [
        'id',
        'idCustomers',
        'idUser',
        'finalPrice',
        'state',
    ];

    public static $rules = [
        // 'idCustomers' => "required",    
    ];

    public $timestamps = true;
}
