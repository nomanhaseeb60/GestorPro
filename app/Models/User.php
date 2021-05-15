<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class  User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'apellidos',
        'dni',
        'fecha_nacimiento',
        'direccion',
        'sueldo',
        'telefono',
        'ciudad',
        'dept_id',
        'id_jefe'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Un empleado puede ser jefe de varios empleados
     */
    public function jefe()
    {
        return $this->belongsTo(User::class,"id_jefe","id_empleado");
    }

    //Relacion Muchos a Uno
    public function departamento(){
        return $this->belongsTo(Departamentos::class,'dept_id','dept_id');
    }

}
