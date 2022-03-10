<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Rol;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("roles.index");
    }


    public function listar($condicion)
    {

        // $roles = roles::all();

        if ($condicion == "deshabilitados") {
            $roles = Rol::select("roles.*")
                ->where('roles.state', "=", "0")
                ->get();
            return DataTables::of($roles)
                ->editColumn("state", function ($rol) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-danger">Inactivo</span>'
                        . '</div>';
                })
                ->addColumn("actions", function ($rol) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="/roles/verDetalles/' . $rol->id . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="/roles/editar/' . $rol->id . '" class="btn btn-warning mx-4 text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="/roles/cambiarEstado/' . $rol->id . '/1" class="btn btn-success text-white"><i class="fas fa-check"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['state', 'actions'])
                ->make(true);
        } else {
            $roles = Rol::select("roles.*")
                ->where('roles.state', "=", "1")
                ->get();
            return DataTables::of($roles)
                ->editColumn("state", function ($rol) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-primary">activo</span>'
                        . '</div>';
                })
                ->addColumn("actions", function ($rol) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="roles/verDetalles/' . $rol->id . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="roles/editar/' . $rol->id . '" class="btn btn-warning mx-4 text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="roles/cambiarEstado/' . $rol->id . '/0" class="btn btn-danger text-white"><i class="fas fa-ban"></i></a>'
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
        return view("roles.create");
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
            'name' => 'required',
            'description' => 'required'

        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'description.required' => 'La :attribute es requerida',
        ];

        $this->validate($request, $campos, $mensaje);

        try {
            Rol::create([
                'name' => $request["name"],
                'description' => $request["description"],
                'state' => 1
            ]);
            return redirect('/roles')->with("success", "el rol fue agregado satisfactoriamente");
        } catch (\Exception $e) {
            return redirect('/roles')->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::find($id);

        return view("roles.verDetalles", compact("rol"));
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
            $rol = Rol::find($id);

            return view("roles.editar", compact("rol"));
        } else {
            return redirect('/roles')->with("error", 'el id del rol no fue encontrado');
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
                'nombre' => 'required',
                'descripcion' => 'required'

            ];

            $mensaje = [
                'required' => 'El :attribute es requerido',
                'descripcion.required' => 'La :attribute es requerida',
            ];

            $this->validate($request, $campos, $mensaje);
            try {
                Rol::where("id", "=", $id)->update([
                    "nombre" => $request["nombre"],
                    "descripcion" => $request["descripcion"]
                ]);
                return redirect('/roles')->with("edit", "el rol fue editado satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/roles')->with("error", $e->getMessage());
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
                Rol::where("id", "=", $id)->update([
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
    public function verDeshabilitados()
    {
        return view("roles.verDeshabilitados");
    }
}
