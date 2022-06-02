<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Sale;
use http\Client;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    const INDEX = '/customers';

    public function index()
    {
        $customers = Customer::where('state', 1)->get();
        $states = 'active';
        return view('customers.index', compact('customers', 'states'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate(Customer::$rules);
        $input = $request->only('name', 'document', 'address', 'phoneNumber', 'state');
        try {
            Customer::create([
                'name' => $input['name'],
                'document' => $input['document'],
                'address' => $input['address'],
                'idUser' => auth()->id(),
                'phoneNumber' => $input['phoneNumber'],
                'state' => 1,
            ]);
            return redirect(self::INDEX)->with('success', 'Se registró el cliente correctamente');
        } catch (\Exception $e) {
            return redirect('/customers/create')->with('error', 'No fue posible registrar el cliente    ');
        }
    }


    public function show($id)
    {
        $customer = Customer::find($id);
        if ($customer == null) {
            return redirect("/customers")->with('error', 'Cliente no encontrado');
        }
        $bookingsAmount = Booking::where('idCustomer', $id)->count();
        $salesAmount = Sale::where('idCustomers', $id)->count();
        return view('customers.details', compact('customer','bookingsAmount', 'salesAmount'));
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        if ($customer == null) {
            return redirect(self::INDEX)->with('error', 'Cliente no encontrado');
        }
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Customer::$rulesUpdate);
        $input = $request->only('name', 'document', 'address', 'phoneNumber');
        $data = [
            'name' => $input['name'],
            'address' => $input['address'],
            'document' => $input['document'],
            'phoneNumber' => $input['phoneNumber'],
        ];
        try {
            $customer = Customer::find($id);
            $customer->update($data);
            return redirect(self::INDEX)->with('success', 'Se ha editado correctamente la información');
        } catch (\Exception $e) {
            return redirect('/customers/' . $id . '/edit')->with('error', 'No se pudo editar la información');
        }
    }

    public function notActive()
    {
        $customers = Customer::select('customers.*', 'users.name as user')
            ->join("users", "customers.idUser", "=", "users.id")
            ->where('customers.state', '0')
            ->get();
        $states = 'false';
        return view('customers.index', compact('customers', 'states'));
    }

    public function updateState($id)
    {
        try {
            $customer = Customer::find($id);
            $customer->update(['state' => !$customer->state]);
            return redirect(self::INDEX)->with('success', 'Se cambió el estado correctamente');
        } catch (\Exception $e) {
            return redirect(self::INDEX)->with('error', 'No fue posible actualizar el estado');
        }
    }
}
