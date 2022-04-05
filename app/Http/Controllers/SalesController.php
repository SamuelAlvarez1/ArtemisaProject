<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Plate;
use App\Models\User;
use http\Client;
use Yajra\DataTables\DataTables;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::select("sales.*", "customers.name as customerName", "users.name as user")
            ->join("customers", "sales.idCustomers", "=", "customers.id")
            ->join("users", "sales.idUser", "=", "users.id")
            ->where('sales.state', '1')
            ->get();

        $states = "active";

        return view('sales.index', compact('sales', 'states'));
    }

    public function canceledSales()
    {
    }

    public function create()
    {
        $customers = Customer::all();
        $users = User::all();
        $plates = Plate::all();


        return view('sales.create', compact('customers', 'users', 'plates'));   
    }

    public function store(Request $request)
    {
        $request->validate(Sale::$rules);
        $input = $request->all();
        try {
            DB::beginTransaction();
            $plate = Sale::create([
                "name" => $input["nombre_platillo"],
                "basePrice" => $input["precio_base"],
                "idCategory" => $input["categories"],
                "state" => 1
            ]);

            if (isset($input["id"])) {
                foreach ($input["id"] as $key => $value) {
                    PlateVariation::create([
                        "variation" => $input["variation"][$key],
                        "idPlate" => $plate->id,
                        "price" => $input["precios"][$key],
                        "description" => $input["description"][$key],
                        "state" => 1
                    ]);
                }
            }

            DB::commit();
            return redirect('/sales')->with('success', 'Se registró la venta correctamente');
        } catch (\Exception $e) {
            return redirect('/sales/create')->with('error', $e->getMessage());
        }
    }

    public function updateState($id)
    {
        try {
            $sale = Sale::find($id);
            $sale->update(['state' => !$sale->state]);
            return redirect('/sales')->with('success', 'Se cambió el estado correctamente');
        } catch (\Exception $e) {
            return redirect('/sales')->with('error', $e->getMessage());
        }
    }
}
