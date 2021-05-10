<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    //Configuracion Modelo
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    /**
     * Fillable
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'correo',
        'telefono',
        'direccion',
        'ciudad'
    ];
}
