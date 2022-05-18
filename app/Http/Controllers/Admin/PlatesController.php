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
            Plate::create([
                "name" => $input["name"],
                "price" => $input["price"],
                "idCategory" => $input["idCategory"],
                "state" => 1
            ]);
            return redirect('/plates')->with('success', 'Platillo creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/plates')->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        $plates = Plate::find($id);
        $platesSalesCount = SaleDetail::where('idPlate', $id)->sum('quantity'); //cantidad de ventas del platillo
        return view('plates.show', compact('plates', 'platesSalesCount'));
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
        $validator = Validator::make($request->all(), Plate::$rulesEdit);
        $validator->after(function ($validator) use ($request, $id) {
            $plate = Plate::where('name', $request->input('name'))->where('id', '!=', $id)->first();
            if ($plate)
                $validator->errors()->add('name', 'Este nombre ya está en uso');
        });
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            Plate::where("id", $id)->update([
                "name" => $request["name"],
                "price" => $request["price"],
                "idCategory" => $request["idCategory"]
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
