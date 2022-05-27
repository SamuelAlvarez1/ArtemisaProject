<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Rol;
use App\Http\Controllers\Controller;
use App\Models\User;

class RolesController extends Controller
{
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
            if($id != 1){
                $rol = Rol::findOrFail($id);
                try {
                    Rol::where("id", "=", $id)->update([
                        "state" => $state
                    ]);
                    User::where("idRol", $rol->id)->update([
                        "state" => $state
                    ]);
                    if ($state == 1) {
                        return redirect('/roles/notActive')->with("success", "cambio de estado exitoso");
                    } else {
                        return redirect('/roles')->with("success", "cambio de estado exitoso");
                    }
                } catch (\Exception $e) {
                    return redirect('/roles')->with("error", "El cambio de estado del rol no se pudo realizar");
                }
            }
            return redirect('/roles')->with("error", "El cambio de estado del rol no se pudo realizar");

        }
    }
    public function create()
    {
        return view("roles.create");
    }

    public function store(Request $request)
    {
        $campos = [
            'name' => 'required|string|unique:roles|min:5|max:20',
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

    public function show($id)
    {
        $rol = Rol::find($id);

        $users = User::select('name', 'last_name', 'email')
        ->where('users.state', 1)
        ->where('users.idRol', $id)->get();

        return view("roles.showDetails", compact('rol', 'users'));
    }

    public function edit($id)
    {
        if ($id != null) {
            $rol = Rol::find($id);

            return view("roles.edit", compact("rol"));
        } else {
            return redirect('/roles')->with("error", 'el id del rol no fue encontrado');
        }
    }

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
}
