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
<<<<<<< HEAD
    
=======


>>>>>>> 0e2857175f10ea88d4fc9b00d92f2e0e22232da8
    public $timestamps = true;

    protected $dates = [
        'created_at',
    ];
}
