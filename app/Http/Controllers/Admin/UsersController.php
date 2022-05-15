<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use DataTables;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select("users.*", "roles.name as rol")
            ->join("roles", "users.idRol", "=", "roles.id")
            ->where("users.state", "=", "1")
            ->get();

        $states = "1";
        return view("users.index", compact("users", "states"));
    }

    public function notActive()
    {
        $users = User::select("users.*", "roles.name as rol")
            ->join("roles", "users.idRol", "=", "roles.id")
            ->where("users.state", "=", "0")
            ->get();

        $states = "0";
        return view("users.index", compact("users", "states"));
    }

    public function updateState($id, $state)
    {
        if ($id != null) {
            try {
                User::where("id", "=", $id)->update([
                    "state" => $state
                ]);
                if ($state == 1) {
                    return redirect('/users/notActive')->with("success", "cambio de estado exitoso");;
                } else {
                    return redirect('/users')->with("success", "cambio de estado exitoso");;
                }
            } catch (\Exception $e) {
                return redirect('/users')->with("error", "El estado del usuarios no se pudo realizar");
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
            'last_name' => 'required|string|min:3|max:40',
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|email|min:10|max:80|unique:users',
            'phone' => 'required|numeric|digits_between:7,10',
            'idRol' => 'required',
            'password' => 'required|min:8|max:80',
            'password_confirmation' => 'required|min:8|max:80|same:password'
        ];

        $this->validate($request, $campos);

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
            if (auth()->user()->idRol != 1 && auth()->user()->id != $id) {
                return redirect('/users/' . auth()->user()->id . "/edit")->with("error", 'Los empleados solo pueden cambiar su propia información');
            }
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
            $user = User::find($id);
            $campos = [
                'last_name' => 'required|string|min:3|max:40',
                'name' => 'required|string|min:3|max:40',
                'email' => 'required|email|min:10|max:80|unique:users,email,' . $user->id,
                'phone' => 'required|string|max:10',

            ];

            if (auth()->user()->idRol == 2 && auth()->user()->id != $id) {
                return redirect('/users/profile/' . auth()->user()->id)->with("error", 'Los empleados solo pueden cambiar su propia información');
            }

            $this->validate($request, $campos);
            try {
                User::where("id", "=", $id)->update([
                    'last_name' => $request['last_name'],
                    'name' =>  $request['name'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                ]);
                if (auth()->user()->idRol == 1 && auth()->user()->id != $id) {
                    return redirect('/users')->with("success", "el usuario fue editado satisfactoriamente");
                }
                return redirect('/users/profile/' . auth()->user()->id)->with("success", 'La información ha sido editada satisfactoriamente');
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
    public function destroy($id)
    {
    }
    public function profile($id)
    {
        if ($id != null) {
            if (auth()->user()->idRol == 1) {
                $user = User::select("users.*", "roles.name as rol")
                    ->join("roles", "users.idRol", "=", "roles.id")
                    ->where("users.id", "=", $id)
                    ->first();

                if ($user != null) {
                    return view("users.profile", compact('user'));
                }
                return redirect('/users')->with("error", 'el usuario no se ha encontrado');
            } else {
                if ($id != auth()->user()->id) {
                    return redirect('/home')->with("error", 'Usted solo puede ver su información personal');
                }
                $user = User::select("users.*", "roles.name as rol")
                    ->join("roles", "users.idRol", "=", "roles.id")
                    ->where("users.id", "=", $id)
                    ->first();

                if ($user != null) {
                    return view("users.profile", compact('user'));
                }
            }
        }
    }

    public function EditPassword($id)
    {
        if ($id != null) {
            $user = User::find($id);
            return view('users.EditPassword', compact('user'));
        }
        return redirect('/users/profile/' . auth()->user()->id)->with("error", 'El usuario no fue encontrado');
    }

    public function updatePassword(Request $request, $id)
    {
        if ($id != null) {
            $campos = [
                'old_password' => 'required|max:80',
                'new_password' => 'required|min:8|max:80',
                'password_confirmation' => 'required|min:8|max:80|same:new_password'
            ];

            $this->validate($request, $campos);
            if (auth()->user()->idRol == 2 && auth()->user()->id != $id) {
                return redirect('/users/profile/' . auth()->user()->id)->with("error", 'Los empleados solo pueden cambiar su propia información');
            }



            if (Hash::check($request->old_password, auth()->user()->password)) {
                User::where("id", $id)->update([
                    'password' => Hash::make($request["new_password"])
                ]);
                return redirect('/users/profile/' . auth()->user()->id)->with("success", 'La contraseña ha sido cambiada satisfactoriamente');
            }
            return redirect('/users/EditPassword/' . auth()->user()->id)->with("error", 'Usted no ha digitado correctamente la antigua contraseña');
        }
    }
}
