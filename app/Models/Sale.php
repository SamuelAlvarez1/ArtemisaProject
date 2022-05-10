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
>>>>>>> 2563cb6fc7fa932292f51865bc898bcfaf8fc39a
    public $timestamps = true;

    protected $dates = [
        'created_at',
    ];
}
