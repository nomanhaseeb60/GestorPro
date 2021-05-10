<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    //Configuracion Modelo
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';

    /**
     * Fillable
     */
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

}
