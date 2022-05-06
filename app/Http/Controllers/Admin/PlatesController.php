<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Plate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DataTables;

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
//         $request->validate(Plate::$rules);

        $input = $request->all();


        try {
            DB::beginTransaction();


            if (isset($input["id"])) {

                $plates = Plate::all();
                $namePlates = [];
                foreach ($input["id"] as $key => $value) {

                    $plates = Plate::where('name', $input["plate"][$key])->first();
                    if ($plates) {
                        $namePlates[sizeof($namePlates)] = $input["plate"][$key];
                    } else {
                        Plate::create([

                        "name" => $input["plate"][$key],
                        "price" => $input["price"][$key],
                        "idCategory" => $input["idCategory"][$key],
                        "state" => 1
                    ]);

                    }
                }

            }else{
                return redirect('/plates')->with('error', 'No agregaste ningún platillo');

            }



            DB::commit();
            if (sizeof($namePlates) > 0) {

                return redirect('/plates')->with(['nameDuplicate' => $namePlates]);
            }
            return redirect('/plates')->with('success', 'Platillo creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/plates')->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        $plates = Plate::find($id);

        return view('plates.show', compact('plates'));
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
        $request->validate(Plate::$rulesEdit);
        if ($id != null) {
            $name = Plate::where('name', $request["plate"]);
            if ($name) {
                return redirect('/plates')->with("error", "El nombre al que quiere actualizar el platillo ya existe");
            }
            try {

                Plate::where("id", $id)->update([
                    "name" => $request["plate"],
                    "price" => $request["price"],
                    "idCategory" => $request["category"]
                ]);
                return redirect('/plates')->with("success", "El platillo fue editado satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/plates')->with("error", $e->getMessage());
            }
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
