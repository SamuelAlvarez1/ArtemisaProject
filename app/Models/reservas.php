<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservas extends Model
{
    use HasFactory;

    protected $table = "reservas";

    protected $fillable = [
        'id',
        'idCliente',
        'idEvento',
        'cantidad_personas',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    public $timestamps = false;
}
