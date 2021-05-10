<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;

    //Configuracion Modelo
    protected $table = 'proyectos';
    protected $primaryKey = 'id_proyecto';

    /**
     * Fillable
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_finalizacion',
        'precio',
        'estado',
        'carpetaDocumentacion'
    ];
}
