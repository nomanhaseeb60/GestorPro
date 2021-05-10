<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use HasFactory;

    protected $table = 'tareas';
    protected $primaryKey = 'id_tarea';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_asignacion',
        'fecha_finalizacion',
        'observacion'
    ];

}
