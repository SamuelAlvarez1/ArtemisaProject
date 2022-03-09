<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use App\Models\Menu;
use App\Models\PlatesVariations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("menu.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view("menu.create", compact("categories"));

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Menu::$rules);
        $input = $request->all();

        try {
            DB::beginTransaction();
            $plate = Menu::create([
                "name" => $input["nombre_platillo"],
                "basePrice" => $input["precio_base"],
                "idCategory" => $input["categories"],
                "state" => 1
            ]);

            foreach ($input["id"] as $key => $value) {
                PlatesVariations::create([
                    "id" => $value,
                    "idPlate" => $plate->id,
                    "price" => $input["precios"][$key],
                    "description" => ""
                ]);
            }

            DB::commit();


            return redirect('/menu')->with('success', 'Factura creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/menu')->with('error', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $plates = Menu::select("plates.*")->get();

        return DataTables::of($plates)
            ->addColumn("state", function ($plate) {
                if ($plate->state == 1) {
                    return '<span class="badge bg-success">Activo</span>';
                }
            })
            ->addColumn("actions", function ($plate) {


            })
            ->rawColumns(['state', 'actions'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
