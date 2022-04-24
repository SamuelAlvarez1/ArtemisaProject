<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Rol;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::select("roles.*")
            ->where('roles.state', "=", "1")
            ->get();

        $states = "1";
        return view("roles.index", compact("roles", "states"));
    }

    public function notActive()
    {
        $roles = Rol::select("roles.*")
            ->where('roles.state', "=", "0")
            ->get();

        $states = "0";
        return view("roles.index", compact("roles", "states"));
    }


    public function updateState($id, $state)
    {
        if ($id != null) {
            try {
                Rol::where("id", "=", $id)->update([
                    "state" => $state
                ]);
                if ($state == 1) {
                    return redirect('/roles/notActive')->with("success", "cambio de estado exitoso");;
                } else {
                    return redirect('/roles')->with("success", "cambio de estado exitoso");;
                }
            } catch (\Exception $e) {
                return redirect('/roles')->with("error", "El estado del rol no se pudo realizar");
            }
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
            'name' => 'required|string|min:5|max:20',
            'description' => 'required|string|min:10|max:50'

        ];

        $this->validate($request, $campos);

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

        return view("roles.showDetails", compact("rol"));
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

            return view("roles.edit", compact("rol"));
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
                'name' => 'required|string|min:5|max:20',
                'description' => 'required|string|min:10|max:50'

            ];
            $this->validate($request, $campos);
            try {
                Rol::where("id", "=", $id)->update([
                    "name" => $request["name"],
                    "description" => $request["description"]
                ]);
                return redirect('/roles')->with("success", "el rol fue editado satisfactoriamente");
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
    public function destroy($id)
    {
    }
}