<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\roles;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        // $usuarios = User::select("users.*", "roles.nombre as rol")
        //     ->join("roles", "users.idRol", "=", "roles.id")
        //     ->get();
        return view("usuarios.index");
    }

    public function listar($condicion)
    {


        if ($condicion == "deshabilitados") {
            $usuarios = User::select("users.*", "roles.nombre as rol")
                ->join("roles", "users.idRol", "=", "roles.id")
                ->where("users.estado", "=", "0")
                ->get();
            return DataTables::of($usuarios)
                ->editColumn("estado", function ($usuario) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-danger">Inactivo</span>'
                        . '</div>';
                })
                ->addColumn("acciones", function ($usuario) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="/usuarios/verDetalles/' . $usuario->id . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="/usuarios/editar/' . $usuario->id . '" class="btn btn-warning mx-4 text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="/usuarios/cambiarEstado/' . $usuario->id . '/1" class="btn btn-success text-white"><i class="fas fa-check"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['estado', 'acciones'])
                ->make(true);
        } else {
            $usuarios = User::select("users.*", "roles.nombre as rol")
                ->join("roles", "users.idRol", "=", "roles.id")
                ->where("users.estado", "=", "1")
                ->get();
            return DataTables::of($usuarios)
                ->editColumn("estado", function ($usuario) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-primary">activo</span>'
                        . '</div>';
                })
                ->addColumn("acciones", function ($usuario) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="usuarios/verDetalles/' . $usuario->id . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="usuarios/editar/' . $usuario->id . '" class="btn btn-warning mx-4 text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="usuarios/cambiarEstado/' . $usuario->id . '/0" class="btn btn-danger text-white"><i class="fas fa-ban"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['estado', 'acciones'])
                ->make(true);
        }
    }

    public function crear()
    {
        $roles = roles::all();

        return view("usuarios.crear", compact('roles'));
    }

    public function insertar(Request $request)
    {
        $campos = [
            'apellido' => 'required',
            'name' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'idRol' => 'required',
            'password' => 'required'
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'password.required' => 'La :attribute es requerida',
        ];

        $this->validate($request, $campos, $mensaje);

        User::create([
            'apellido' => $request['apellido'],
            'name' =>  $request['name'],
            'email' => $request['email'],
            'telefono' => $request['telefono'],
            'estado' => 1,
            'idRol' => $request['idRol'],
            'password' => Hash::make($request['password']),

        ]);

        return redirect("/usuarios")->with("success", "Usuario agregado satisfactoriamente");
    }

    public function editar($id)
    {
        if ($id != null) {
            $usuario = User::find($id);
            $roles = roles::all();

            return view("usuarios.editar", compact("usuario", "roles"));
        } else {
            return redirect('/usuarios')->with("error", 'el id del usuario no fue encontrado');
        }
    }

    public function actualizar($id, Request $request)
    {
        if ($id != null) {
            $campos = [
                'apellido' => 'required',
                'name' => 'required',
                'email' => 'required',
                'telefono' => 'required',
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
                    'apellido' => $request['apellido'],
                    'name' =>  $request['name'],
                    'email' => $request['email'],
                    'telefono' => $request['telefono'],
                    'idRol' => $request['idRol'],
                    'password' => Hash::make($request['password']),
                ]);
                return redirect('/usuarios')->with("edit", "el usuario fue editado satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/usuarios')->with("error", $e->getMessage());
            }
        }
    }

    public function cambiarEstado($id, $estado)
    {
        if ($id != null) {
            try {
                User::where("id", "=", $id)->update([
                    "estado" => $estado
                ]);
                if ($estado == 1) {
                    return redirect('/usuarios/verDeshabilitados')->with("success", "cambio de estado exitoso");
                } else {
                    return redirect('/usuarios')->with("success", "cambio de estado exitoso");;
                }
            } catch (\Exception $e) {
                return redirect('/usuarios')->with("error", "el estado del usuario no se pudo cambiar");
            }
        }
    }

    public function verDetalles($id)
    {
        $usuario = User::find($id);

        return view("usuarios.verDetalles", compact("usuario"));
    }

    public function verDeshabilitados()
    {
        return view("usuarios.verDeshabilitados");
    }
}
