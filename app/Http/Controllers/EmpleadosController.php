<?php


namespace App\Http\Controllers;


use App\Models\Departamentos;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class EmpleadosController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        $empleados = User::with('roles')->get();
        return view("empleados.listado",["empleados" => $empleados]);
    }

    public function create()
    {
        //devolver la vista para crear un Empleado
        //devolver departamento y roles
        $roles = Role::all()->pluck('name');
        $empleados = User::all()->pluck('nombre');
        $departamentos = Departamentos::all()->pluck('nombre');
        return view("empleados.nuevo",["roles"=>$roles,"departamentos" => $departamentos,"empleados"=>$empleados]);
    }

    /**
     * Guardar el nuevo empleado
     * @param Request $request
     */
    public function store(Request $request){
        //Validar los datos
        $this->getValidate();
        $empleado = new User();
        //Rellanar los datos
        $empleado->nombre = $request->nombre;
        $empleado->apellidos = $request->apellidos;
        $empleado->email = $request->email;
        $empleado->dni = $request->dni;
        $empleado->password = Hash::make($request->password);
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->sueldo = $request->sueldo;
        $empleado->telefono = $request->telefono;
        $empleado->ciudad = $request->ciudad;
        $empleado->dept_id = DB::table('departamentos')
            ->select('dept_id')->where('nombre',$request->departamento)->pluck('dept_id')[0];
        $empleado->assignRole("$request->role");
        $empleado->id_jefe = DB::table('empleados')
            ->select('id_empleado')->where('nombre',$request->jefe)->pluck('id_empleado')[0];
        //Guardar en la base de datos
        $empleado->save();
        //Devolver la vista con el usuario agregado
        $empleados = User::all();
        return view("empleados.listado",["msj"=>"El empleado $empleado->nombre se ha dado de alta correctamente","empleados"=>$empleados]);
    }
    public function show(User $empleado){

    }

    /**
     * Mandar el formulario de modificar un usuario
     * @param User $empleado
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $empleado)
    {
        $roles = DB::table('roles')->select('id','name')->get();
        $empleados = DB::table('empleados')->select('id_empleado','nombre')->get();
        $departamentos = Departamentos::all();
        return view("empleados.modificar",["roles"=>$roles,"departamentos" => $departamentos,"empleados"=>$empleados,"emp"=>$empleado]);
    }

    /**
     * Borrar un empleado
     * @param Departamentos $empleado
     */
    public function destroy(User $empleado){
        $empleado->delete();
        $empleados = User::all();
        return view("empleados.listado",["msj"=>"El empleado $empleado->nombre se ha dado de alta correctamente","empleados"=>$empleados]);
    }

    public function update(User $empleado,Request $request){
        //Rellanar los datos
        $empleado->nombre = $request->nombre;
        $empleado->apellidos = $request->apellidos;
        $empleado->email = $request->email;
        $empleado->dni = $request->dni;
        $empleado->password = $empleado->password;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->sueldo = $request->sueldo;
        $empleado->telefono = $request->telefono;
        $empleado->ciudad = $request->ciudad;
        $empleado->dept_id = DB::table('departamentos')
            ->select('dept_id')->where('nombre',$request->departamento)->pluck('dept_id')[0];
        $empleado->assignRole("$request->role");
        $empleado->id_jefe = DB::table('empleados')
            ->select('id_empleado')->where('nombre',$request->jefe)->pluck('id_empleado')[0];
        //Guardar en la base de datos
        $empleado->save();
        //Devolver la vista con el usuario agregado
        $empleados = User::all();
        return view("empleados.listado",["msj"=>"El empleado $empleado->nombre se ha actualizado correctamente","empleados"=>$empleados]);

    }
    public function getValidate(): void
    {
        /*Comprobacion de los datos*/
        $this->validate(request(), [
            'nombre' => array('required', 'max:255'),
            'apellidos' => array('required','max:255'),
            'email' => array('required', 'email', 'max:255', 'unique:empleados'),
            'password' => array('required', 'min:8'),
            'dni' => array('required', 'string','regex:/([a-z]|[A-Z]|[0-9])[0-9]{7}([a-z]|[A-Z]|[0-9])/u','unique:empleados'),
            'fecha_nacimiento' => array('required','date'),
            'departamento' => array('required'),
            'role' => array('required')
        ], $messages = [
            'required' => 'El campo :attribute es obligatorio',
            'regex' => 'El campo :attribute no es valido',
            'unique' => 'El empleado ya exsiste',
            'confirmed' => 'La contraseña no coincede',
            'min' => 'La contraseña tiene que tener minimo 8 caracteres'
        ]);
    }
}
