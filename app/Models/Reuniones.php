<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reuniones extends Model
{
    use HasFactory;

    //Configuracion Modelo
    protected $table = 'reuniones';
    protected $primaryKey = 'id_reunion';
    public $timestamps = false;

    /**
     * Fillable
     */
    protected $fillable = [
        'fecha',
        'notas',
        'preguntas'
    ];
}
