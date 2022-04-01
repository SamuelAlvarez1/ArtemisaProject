<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Rol;
use App\Models\User;
use http\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomersController extends Controller
{

    public function index()
    {
        $customers = Customer::where('state',1)->get();
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
        $input['state'] = 0 ? $input['state'] != 'on' : 1;
        try {
            Customer::create([
                'name' => $input['name'],
                'document' => $input['document'],
                'address' => $input['address'],
                'idUser' => auth()->user()->id,
                'phoneNumber' => $input['phoneNumber'],
                'state' => $input['state'],
            ]);
            return redirect('/customers')->with('success', 'Se registró el cliente correctamente');
        } catch (\Exception $e) {
            return redirect('/customers/create')->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        $customer = Customer::find($id);
        if ($customer == null)  return redirect("/customers")->with('error', 'Cliente no encontrado');
        $user = User::find($customer->idUser);
        $role = Rol::find($user->idRol);
        return view('customers.details', compact('customer', 'user','role'));
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        if ($customer == null) {
            return redirect("/customers")->with('error', 'Cliente no encontrado');
        }
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Customer::$rulesUpdate);
        $input = $request->only('name', 'document', 'address', 'phoneNumber', 'state');
        $data = [
            'name' => $input['name'],
            'address' => $input['address'],
            'document' => $input['document'],
            'phoneNumber' => $input['phoneNumber'],
            'state' => $input['state'],
        ];
        try {
            $customer = Customer::find($id);
            $customer->update($data);
            return redirect('/customers')->with('success', 'Se ha editado correctamente la información');
        } catch (\Exception $e) {
            return redirect('/customers/' . $id . '/edit')->with('error', 'No se pudo editar la información');
        }
    }


    public function destroy($id)
    {
        //
    }

    public function notActive()
    {
        $customers = Customer::select('customers.*', 'users.name as user')
            ->join("users", "customers.idUser", "=", "users.id")
            ->where('customers.state', '0')
            ->paginate(20);
        $states = 'false';
        return view('customers.index', compact('customers', 'states'));
    }

    public function updateState($id)
    {
        try {
            $customer = Customer::find($id);
            $customer->update(['state' => !$customer->state]);
            return redirect('/customers')->with('success', 'Se cambió el estado correctamente');
        } catch (\Exception $e) {
            return redirect('/customers')->with('error', $e->getMessage());
        }
    }
}
