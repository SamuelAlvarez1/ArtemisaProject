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
        $image = null;
        $input = $request->all();

        if ($request->image) {
            $image = $input['name'] . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $image);
        }
        try {
            Plate::create([
                "name" => $input["name"],
                "price" => $input["price"],
                "idCategory" => $input["idCategory"],
                "state" => 1,
                'image' => $image
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
            if ($plate) {
                $validator->errors()->add('name', 'Este nombre ya está en uso');
            }
        });
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $image = null;
        $input = $request->all();
        $data = [];
        if ($request->image){
            $plate = Plate::find($id);
            $this->removeImage($plate->image);
            $image = $input['name'].time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'),$image);
            $data = ['image' => $image];
        }
        try {
            Plate::where("id", $id)->update([
                "name" => $input["name"],
                "price" => $input["price"],
                "idCategory" => $input["idCategory"],
                'image' => $data['image']
            ]);
            return redirect('/plates')->with("success", "El platillo fue editado satisfactoriamente");
        } catch (\Exception $e) {
            return redirect('/plates')->with("error", "No fue posible actualizar el platillo");
        }
    }

    public function getPricePlate($id)
    {
        return Plate::select("plates.price")->where("id", $id)->first();
    }

    public function removeImage($image)
    {
        if(\File::exists(public_path('uploads/'. $image))){
            \File::delete(public_path('uploads/'. $image));
        }
    }

    public function removeImageAction($id)
    {
        $plate = Plate::find($id);

        if ($plate->image == ''){
            return redirect('/plates')->with("error", "Este platillo no tiene imagen");
        }
        $this->removeImage($plate->image);
        $plate->image = '';
        $plate->save();
        return redirect('/plates')->with("success", "La imagen fue removida satisfactoriamente");
    }
}
