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

    /**
     * Fillable
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'horas',
        'estado',
        'fecha_comienzo',
        'fecha_finalizacion',
        'id_proyecto'
    ];

    /*Muchos sprints pueden ser de un proyecto*/
    public function proyecto(){
        return $this->belongsTo(Proyectos::class,'id_proyecto','id_proyecto');
    }
}
