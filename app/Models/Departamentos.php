<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;
    //Configuracion Modelo
    protected $table = 'departamentos';
    protected $primaryKey = 'dept_id';
    /**
     * Fillable
     */
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

}
