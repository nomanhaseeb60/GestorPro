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
        'observacion',
        'id_empleado',
        'id_sprint'
    ];

    //Un empleado puede tener varias tareas
    public function empleado()
    {
        return $this->hasMany(User::class,'id_empleado','id_empleado');
    }

    //Varias tareas a un sprint
    public function sprint(){
        return $this->belongsTo(Sprints::class,'id_sprint','id_sprint');
    }

}
