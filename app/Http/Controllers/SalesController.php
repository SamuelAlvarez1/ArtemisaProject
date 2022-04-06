<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Plate;
use App\Models\User;
use App\Models\SaleDetail;
use http\Client;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::select("sales.*", "customers.name as customerName", "users.name as userName")
            ->join("customers", "sales.idCustomers", "=", "customers.id")
            ->join("users", "sales.idUser", "=", "users.id")
            ->where('sales.state', '1')
            ->get();
        // dd($sales);

        $states = "activeSales";

        return view('sales.index', compact('sales', 'states'));
    }

    public function canceledSales()
    {
        $sales = Sale::select("sales.*", "customers.name as customerName", "users.name as userName")
            ->join("customers", "sales.idCustomers", "=", "customers.id")
            ->join("users", "sales.idUser", "=", "users.id")
            ->where('sales.state', '0')
            ->get();
        // dd($sales);

        $states = "canceledSales";

        return view('sales.index', compact('sales', 'states'));
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
        // $request->validate(Sale::$rules);

        try {
            DB::beginTransaction();
            $sale = Sale::create([
                "idCustomers" => $request["customer"],
                "finalPrice" => $request["totalPrice"],
                "state" => 1,
                'idUser' => auth()->user()->id
            ]);

            if (isset($request["idPlatillo"])) {
                foreach ($request["idPlatillo"] as $key => $value) {
                    SaleDetail::create([
                        'idSales' => $sale->id,
                        "idPlate" => $value,
                        "quantity" => $request["cantidades"][$key],
                        "platePrice" => $request["precios"][$key],

                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            return redirect('/sales/create')->with('error', $e->getMessage());
        }
        return redirect('/sales')->with('success', 'Se registró la venta correctamente');
    }

    public function updateState($id)
    {
        try {
            $sale = Sale::find($id);
            $sale->update(['state' => !$sale->state]);
            if ($sale->state == 0) {
                return redirect('/sales')->with('success', 'Se cambió el estado correctamente');
            } else {
                return redirect('/sales/canceledSales')->with('success', 'Se cambió el estado correctamente');
            }
        } catch (\Exception $e) {
            return redirect('/sales')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $sale = Sale::select("sales.*", "customers.name as customerName", "users.name as userName")
            ->join("customers", "sales.idCustomers", "=", "customers.id")
            ->join("users", "sales.idUser", "=", "users.id")
            ->where("sales.id", "=", $id)
            ->first();

        $saleDetail = SaleDetail::select("sales_details.*", "plates.name as namePlate")
            ->join("plates", "sales_details.idPlate", "=", "plates.id")
            ->where("sales_details.idSales", "=", $id)
            ->get();


        return view('sales.show', compact('sale', 'saleDetail'));
    }
}
