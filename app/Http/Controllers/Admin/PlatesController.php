<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Plate;
use App\Models\PlateVariation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DataTables;

class PlatesController extends Controller
{
    public function index()
    {
        $plates = Plate::join('categories', 'plates.idCategory', '=', 'categories.id')
        ->select('categories.name as categories', 'plates.*')
        ->where('state', '1')->get();
        $infoVariations = PlateVariation::all();
        $states = "active";
        $variations = [];
        $categories = 0;

        foreach ($plates as $plate){
            $variations[] += PlateVariation::where('state', '1')->where('idPlate', $plate->id)->count();
        }



        return view("plates.index", compact('plates', 'variations', 'states', 'categories', 'infoVariations'));
    }

    public function notActive()
    {
        $plates = Plate::join('categories', 'plates.idCategory', '=', 'categories.id')
            ->select('categories.name as categories', 'plates.*')
            ->where('state', '0')->get();
        $infoVariations = PlateVariation::all();
        $states = "false";
        $variations = [];

        $categories = 0;


        foreach ($plates as $plate){
            $variations[] += PlateVariation::where('state', '1')->where('idPlate', $plate->id)->count();
        }


        return view("plates.index", compact('plates', 'variations', 'states', 'categories', 'infoVariations'));
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

    public function updateStateVariation($id)
    {
        try {
            $variation = PlateVariation::find($id);
            $variation->update(['state' => !$variation->state]);
            return redirect('/plates/'.$variation->idPlate.'/edit')->with('success', 'Se deshabilitó el estado de la variación correctamente');
        } catch (\Exception $e) {
            return redirect('/plates/'.$variation->idPlate.'/edit')->with('error', $e->getMessage());
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
            $plate = Plate::create([
                "name" => $input["nombre_platillo"],
                "basePrice" => $input["precio_base"],
                "idCategory" => $input["categories"],
                "state" => 1
            ]);

            foreach ($input["id"] as $key => $value) {
                PlateVariation::create([

                    "variation" => $input["variation"][$key],
                    "idPlate" => $plate->id,
                    "price" => $input["precios"][$key],
                    "description" => $input["description"][$key],
                    "state" => 1
                ]);
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

        $variations = PlateVariation::where('state', '1')->where('idPlate', $id)->get();

        return view('plates.show', compact('plates', 'variations'));


    }


    public function edit($id)
    {
    $plate = Plate::find($id);
    $variations = PlateVariation::where('state', '1')->where('idPlate',$id)->get();
    $categories = Category::all();

        if ($plate == null) {
            return redirect('/plate')->with('error', 'Platillo no encontrado');
        }

        return view("plates.edit", compact('plate','variations','categories'));

    }

    public function addVariation()
    {
        return view('plates.addVariations');
    }


    public function update(Request $request, $id)
    {
        if ($id != null) {
           $request->validate(Plate::$rules);
            try {
                Plate::where("id", "=", $id)->update([
                    'name' =>  $request['name'],
                    'basePrice' => $request['basePrice'],
                    'state' => $request['state'],
                ]);
                return redirect('/plates')->with("edit", "El platillo fue editado satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/plates')->with("error", $e->getMessage());
            }
        }
    }

    public function destroy($id)
    {
        //
    }
}
