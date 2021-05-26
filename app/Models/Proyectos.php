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
        'carpetaDocumentacion',
        'id_categoria',
        'id_cliente'
    ];
    //Muchos proyectos pueden ser de un cliente
    public function cliente(){
        return $this->belongsTo(Clientes::class,'id_cliente','id_cliente','id_cliente');
    }

}
