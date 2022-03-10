<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use DataTables;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("users.index");
    }


    public function listar($condicion)
    {


        if ($condicion == "deshabilitados") {
            $users = User::select("users.*", "roles.name as rol")
                ->join("roles", "users.idRol", "=", "roles.id")
                ->where("users.state", "=", "0")
                ->get();
            return DataTables::of($users)
                ->editColumn("state", function ($user) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-danger">Inactivo</span>'
                        . '</div>';
                })
                ->addColumn("actions", function ($user) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="/usuarios/verDetalles/' . $user->id . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="/usuarios/editar/' . $user->id . '" class="btn btn-warning mx-4 text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="/usuarios/cambiarEstado/' . $user->id . '/1" class="btn btn-success text-white"><i class="fas fa-check"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['state', 'actions'])
                ->make(true);
        } else {
            $users = User::select("users.*", "roles.name as rol")
                ->join("roles", "users.idRol", "=", "roles.id")
                ->where("users.state", "=", "1")
                ->get();
            return DataTables::of($users)
                ->editColumn("state", function ($user) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-primary">activo</span>'
                        . '</div>';
                })
                ->addColumn("actions", function ($user) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="usuarios/verDetalles/' . $user->id . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="usuarios/editar/' . $user->id . '" class="btn btn-warning mx-4 text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="usuarios/cambiarEstado/' . $user->id . '/0" class="btn btn-danger text-white"><i class="fas fa-ban"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['state', 'actions'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();

        return view("users.create", compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'last_name' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'idRol' => 'required',
            'password' => 'required'
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'password.required' => 'La :attribute es requerida',
        ];

        $this->validate($request, $campos, $mensaje);

        User::create([
            'last_name' => $request['last_name'],
            'name' =>  $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'state' => 1,
            'idRol' => $request['idRol'],
            'password' => Hash::make($request['password']),

        ]);

        return redirect("/users")->with("success", "Usuario agregado satisfactoriamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select("users.*", "roles.name as rol")
            ->join("roles", "users.idRol", "=", "roles.id")
            ->where("users.id", "=", $id)
            ->get();

        foreach ($user as $u) {
            $user = $u;
        }
        return view("users.showDetails", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id != null) {
            $user = User::find($id);
            $roles = Rol::all();

            return view("users.edit", compact("user", "roles"));
        } else {
            return redirect('/users')->with("error", 'el id del usuario no fue encontrado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id != null) {
            $campos = [
                'last_name' => 'required',
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'idRol' => 'required',
                'password' => 'required',

            ];

            $mensaje = [
                'required' => 'El :attribute es requerido',
                'password.required' => 'La contraseña es requerida',
            ];

            $this->validate($request, $campos, $mensaje);
            try {
                User::where("id", "=", $id)->update([
                    'last_name' => $request['last_name'],
                    'name' =>  $request['name'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'idRol' => $request['idRol'],
                    'password' => Hash::make($request['password']),
                ]);
                return redirect('/users')->with("edit", "el usuario fue editado satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/users')->with("error", $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $estado)
    {
        if ($id != null) {
            try {
                User::where("id", "=", $id)->update([
                    "state" => $estado
                ]);
                if ($estado == 1) {
                    return redirect('/users/verDeshabilitados')->with("success", "cambio de estado exitoso");
                } else {
                    return redirect('/users')->with("success", "cambio de estado exitoso");;
                }
            } catch (\Exception $e) {
                return redirect('/users')->with("error", "el estado del usuario no se pudo cambiar");
            }
        }
    }
    public function verDeshabilitados()
    {
        return view("users.verDeshabilitados");
    }
}
