<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Plate;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;

class PlatesController extends Controller
{
    public function index()
    {
        $plates = Plate::select('categories.name as categories', 'plates.*')
            ->join('categories', 'plates.idCategory', '=', 'categories.id')
            ->where('plates.state', '1')->get();
        $states = "active";

        return view("plates.index", compact('plates', 'states'));
    }

    public function notActive()
    {
        $plates = Plate::join('categories', 'plates.idCategory', '=', 'categories.id')
            ->select('categories.name as categories', 'plates.*')
            ->where('plates.state', '0')->get();
        $states = "false";


        $categories = 0;

        return view("plates.index", compact('plates', 'states', 'categories'));
    }

    public function updateState($id)
    {
        try {
            $plate = Plate::find($id);
            $plate->update(['state' => !$plate->state]);
            return redirect('/plates')->with('success', 'Se cambió el estado correctamente');
        } catch (\Exception $e) {
            return redirect('/plates')->with('error', $e->getMessage());
        }
    }


    public function create()
    {
        $categories = Category::where('state', '1')->get();
        return view("plates.create", compact("categories"));
    }


    public function store(Request $request)
    {

         $request->validate(Plate::$rules);
        $input = $request->all();
        try {

<<<<<<< HEAD
                $plates = Plate::all();
                $namePlates = [];
                foreach ($input["id"] as $key => $value) {

                    $plates = Plate::where('name', $input["plate"][$key])->first();
                    if ($plates) {
                        $namePlates[sizeof($namePlates)] = $input["plate"][$key];
                    } else {
                        Plate::create([
                            "name" => $input["plate"][$key],
                            "price" => $input["prices"][$key],
                            "idCategory" => $input["categories"][$key],
                            "state" => 1
                        ]);
                    }
                }
            }

            DB::commit();
            if (sizeof($namePlates) > 0) {

                return redirect('/plates')->with(['nameDuplicate' => $namePlates]);
            }
=======
                        Plate::create([
                        "name" => $input["name"],
                        "price" => $input["price"],
                        "idCategory" => $input["idCategory"],
                        "state" => 1
                    ]);

>>>>>>> 0d43536de06425a0ed5a2430b73a4f7ce2c5a93c
            return redirect('/plates')->with('success', 'Platillo creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/plates')->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        $plates = Plate::find($id);
<<<<<<< HEAD

        return view('plates.show', compact('plates'));
=======
        $platesSalesCount = SaleDetail::where('idPlate', $id)->sum('quantity'); //cantidad de ventas del platillo
        return view('plates.show', compact('plates', 'platesSalesCount'));
>>>>>>> 0d43536de06425a0ed5a2430b73a4f7ce2c5a93c
    }


    public function edit($id)
    {
        $plate = Plate::find($id);
        $categories = Category::all();

        if ($plate == null) {
            return redirect('/plate')->with('error', 'Platillo no encontrado');
        }

        return view("plates.edit", compact('plate', 'categories'));
    }


    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        if ($id != null) {
            $name = Plate::where('name', $request["plate"]);
            if ($name) {
                return redirect('/plates')->with("error", "El nombre al que quiere actualizar el platillo ya existe");
            }
=======
        $validator = Validator::make($request->all(), Plate::$rulesEdit);
        $validator->after(function ($validator) use ($request, $id){
            $plate = Plate::where('name', $request->input('name'))->where('id','!=', $id)->first();
            if ($plate)
                $validator->errors()->add('name', 'Este nombre ya está en uso');
        });
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
>>>>>>> 0d43536de06425a0ed5a2430b73a4f7ce2c5a93c
            try {

                Plate::where("id", $id)->update([
                    "name" => $request["name"],
                    "price" => $request["price"],
<<<<<<< HEAD
                    "idCategory" => $request["category"]
=======
                    "idCategory" => $request["idCategory"]
>>>>>>> 0d43536de06425a0ed5a2430b73a4f7ce2c5a93c
                ]);
                return redirect('/plates')->with("success", "El platillo fue editado satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/plates')->with("error", $e->getMessage());
            }

    }

    public function destroy($id)
    {
        //
    }

    public function getPricePlate($id)
    {
        $price = Plate::select("plates.price")->where("id", $id)->first();
        return $price;
    }

}
