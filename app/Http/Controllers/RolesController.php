<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\roles;

class RolesController extends Controller
{
    public function index()
    {
        return view("roles.index");
    }
    public function listar($condicion)
    {

        // $roles = roles::all();

        if ($condicion == "deshabilitados") {
            $roles = roles::select("roles.*")
                ->where('roles.estado', "=", "0")
                ->get();
            return DataTables::of($roles)
                ->editColumn("estado", function ($rol) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-danger">Inactivo</span>'
                        . '</div>';
                })
                ->addColumn("acciones", function ($rol) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="/roles/verDetalles/' . $rol->id . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="/roles/editar/' . $rol->id . '" class="btn btn-warning mx-4 text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="/roles/cambiarEstado/' . $rol->id . '/1" class="btn btn-success text-white"><i class="fas fa-check"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['estado', 'acciones'])
                ->make(true);
        } else {
            $roles = roles::select("roles.*")
                ->where('roles.estado', "=", "1")
                ->get();
            return DataTables::of($roles)
                ->editColumn("estado", function ($rol) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-primary">activo</span>'
                        . '</div>';
                })
                ->addColumn("acciones", function ($rol) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="roles/verDetalles/' . $rol->id . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="roles/editar/' . $rol->id . '" class="btn btn-warning mx-4 text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="roles/cambiarEstado/' . $rol->id . '/0" class="btn btn-danger text-white"><i class="fas fa-ban"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['estado', 'acciones'])
                ->make(true);
        }
    }

    public function crear()
    {
        return view("roles.crear");
    }

    public function guardar(Request $request)
    {
        $campos = [
            'nombre' => 'required',
            'descripcion' => 'required'

        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'descripcion.required' => 'La :attribute es requerida',
        ];

        $this->validate($request, $campos, $mensaje);

        try {
            roles::create([
                'nombre' => $request["nombre"],
                'descripcion' => $request["descripcion"],
                'estado' => 1
            ]);
            return redirect('/roles')->with("success", "el rol fue agregado satisfactoriamente");
        } catch (\Exception $e) {
            return redirect('/roles')->with("error", $e->getMessage());
        }
    }

    public function editar($id)
    {
        if ($id != null) {
            $rol = roles::find($id);

            return view("roles.editar", compact("rol"));
        } else {
            return redirect('/roles')->with("error", 'el id del rol no fue encontrado');
        }
    }

    public function actualizar($id, Request $request)
    {
        if ($id != null) {
            $campos = [
                'nombre' => 'required',
                'descripcion' => 'required'

            ];

            $mensaje = [
                'required' => 'El :attribute es requerido',
                'descripcion.required' => 'La :attribute es requerida',
            ];

            $this->validate($request, $campos, $mensaje);
            try {
                roles::where("id", "=", $id)->update([
                    "nombre" => $request["nombre"],
                    "descripcion" => $request["descripcion"]
                ]);
                return redirect('/roles')->with("edit", "el rol fue editado satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/roles')->with("error", $e->getMessage());
            }
        }
    }

    public function cambiarEstado($id, $estado)
    {
        if ($id != null) {
            try {
                roles::where("id", "=", $id)->update([
                    "estado" => $estado
                ]);
                if ($estado == 1) {
                    return redirect('/roles/verDeshabilitados')->with("success", "cambio de estado exitoso");;
                } else {
                    return redirect('/roles')->with("success", "cambio de estado exitoso");;
                }
            } catch (\Exception $e) {
                return redirect('/roles')->with("error", "El estado del rol no se pudo realizar");
            }
        }
    }

    public function verDetalles($id)
    {
        $rol = roles::find($id);

        return view("roles.verDetalles", compact("rol"));
    }

    public function verDeshabilitados()
    {
        return view("roles.verDeshabilitados");
    }
}
