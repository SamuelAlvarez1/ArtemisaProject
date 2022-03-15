<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlateVariation extends Model
{
    use HasFactory;

    protected $table = "plates_variations";

    protected $fillable = [
      'id',
      'variation',
      'price',
      'description',
      'idPlate'
    ];

    public $timestamps = true;
}
