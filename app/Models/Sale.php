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
<<<<<<< HEAD
        'idCustomers' => "required",

=======
        // 'idCustomers' => "required",    
>>>>>>> 44f695cc7460b06fd787493656dbe3feab67ffc6
    ];

    public $timestamps = true;
}
