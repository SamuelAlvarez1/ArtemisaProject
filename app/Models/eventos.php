<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventos extends Model
{
    use HasFactory;

    protected $table = "eventos";

    protected $fillable = [
        'id',
        'nombre',
        'valor_decoracion',
        'valor_entrada',
        'descripcion',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    public $timestamps = false;
}
