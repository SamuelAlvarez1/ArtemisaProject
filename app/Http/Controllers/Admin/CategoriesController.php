<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Rol;
use App\Models\User;
use App\Models\Plate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::where('state', 1)->get();
        $states = 'active';
        return view('categories.index', compact('categories', 'states'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(Category::$rules);
        $input = $request->all();
        try {
            Category::create([
                'name' => $input['name'],
                'idUser' => auth()->user()->id,
                'state' => $input['state'],
            ]);
            return redirect('/categories')->with('success', 'Se registró la categoría correctamente');
        } catch (\Exception $e) {
            return redirect('/categories/create')->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect("/categories")->with('error', 'Categoría no encontrado');
        }
        $user = User::find($category->idUser);
        $role = Rol::find($user->idRol);
        return view('categories.details', compact('category', 'user', 'role'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect("/categories")->with('error', 'Categoría no encontrado');
        }
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Category::$rulesEdit);
        $validator->after(function ($validator) use ($request, $id){
            $category = Category::where('name', $request->input('name'))->where('id','!=', $id)->first();
            if ($category) {
                $validator->errors()->add('name', 'Este nombre ya está en uso');
            }
        });
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $data = [
            'name' => $input['name'],
            'state' => $input['state'],
        ];
        try {
            $category = Category::find($id);
            $category->update($data);
            return redirect('/categories')->with('success', 'Se ha editado correctamente la información');
        } catch (\Exception $e) {
            return redirect('/categories/' . $id . '/edit')->with('error', 'No se pudo editar la información');
        }
    }

    public function notActive()
    {
        $categories = Category::select('categories.*', 'users.name as user')
            ->join("users", "categories.idUser", "=", "users.id")
            ->where('categories.state', '0')
            ->paginate(20);
        $states = 'false';
        return view('categories.index', compact('categories', 'states'));
    }

    public function updateState($id)
    {
        try {
            $categories = Category::find($id);
            Plate::where("idCategory", $id)->update([
                "state" => !$categories->state
            ]);
            $categories->update(['state' => !$categories->state]);
            return redirect('/categories')->with('success', 'Se cambió el estado correctamente');
        } catch (\Exception $e) {
            return redirect('/categories')->with('error', $e->getMessage());
        }
    }
}
