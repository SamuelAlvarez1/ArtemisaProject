<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use http\Client;
use Yajra\DataTables\DataTables;

class SalesController extends Controller
{
    public function index()
    {
        $bookings = Sale::select("sales.*", "customers.name as customerName", "events.name as eventName", "users.name as user")
            ->join("customers", "sales.idCustomer", "=", "customers.id")
            ->join("users", "sales.idUser", "=", "users.id")
            ->where("sales.state", "=", 1)
            ->get();

        // dd($bookings);
        $states = "1";
        return view('sales.index', compact('sales', 'states'));
    }

    public function canceledSales()
    {
    }

    public function create()
    {
        return view('sales.create');
    }

    public function store(Request $request)
    {
        $request->validate(Sale::$rules);
        $input = $request->all();
        try {
            Sale::create([
                "idCustomers" => $input['idCostumers'],
                "idUser" => auth()->user()->id,
                "state" => $input['state'],
                "iva" => $input['iva']
            ]);
            return redirect('/sales')->with('success', 'Se registró la venta correctamente');
        } catch (\Exception $e) {
            return redirect('/sales/create')->with('error', $e->getMessage());
        }
    }

    public function updateState($id, $state)
    {
        if ($id != null) {
            try {
                Sale::where("id", "=", $id)->update([
                    "state" => $state
                ]);
                if ($state == 1) {
                    return redirect('/sales/canceledSales')->with("success", "cambio de estado exitoso");;
                } else {
                    return redirect('/sales')->with("success", "cambio de estado exitoso");;
                }
            } catch (\Exception $e) {
                return redirect('/bookings')->with("error", "El estado de la venta no se pudo realizar");
            }
        }
    }
}
