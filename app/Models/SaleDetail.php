<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;


    protected $table = "sales_details";

    protected $fillable = [
        'id',
        'subTotal',
        'quantity',
        'idSales',
        'idVatiariation',
        'state'
    ];

    public static $rules = [
    ];

    public $timestamps = true;
}
