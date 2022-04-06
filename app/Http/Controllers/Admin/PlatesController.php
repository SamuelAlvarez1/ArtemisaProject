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
            ->where('state', '1')->get();
        $states = "active";

        return view("plates.index", compact('plates', 'states'));
    }

    public function notActive()
    {
        $plates = Plate::join('categories', 'plates.idCategory', '=', 'categories.id')
            ->select('categories.name as categories', 'plates.*')
            ->where('state', '0')->get();
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
        $categories = Category::all();
        return view("plates.create", compact("categories"));

    }


    public function store(Request $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();


            if (isset($input["id"])) {
                foreach ($input["id"] as $key => $value) {
                    Plate::create([
                        "name" => $input["plate"][$key],
                        "price" => $input["prices"][$key],
                        "idCategory" => $input["categories"][$key],
                        "state" => 1
                    ]);
                }
            }

            DB::commit();

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
        if ($id != null) {
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

    public function getPricePlate($id){
        $price = Plate::select("plates.price")->where("id", $id)->first();

        return $price;
    }
}
