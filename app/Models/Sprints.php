<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprints extends Model
{
    use HasFactory;

    //Configuracion Modelo
    protected $table = 'sprints';
    protected $primaryKey = 'id_sprint';
    public $timestamps = false;

    /**
     * Fillable
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'horas',
        'estado',
        'fecha_comienzo',
        'fecha_finalizacion'
    ];
}
