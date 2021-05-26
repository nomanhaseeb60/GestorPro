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

    /**
     * Fillable
     */
    protected $fillable = [
        'nombre',
        'fecha',
        'notas',
        'preguntas',
        'id_sprint'
    ];

    //Una reunion
    public function sprint(){
        $this->belongsToMany('id_sprint', 'reuniones','id_sprint');
    }
}
