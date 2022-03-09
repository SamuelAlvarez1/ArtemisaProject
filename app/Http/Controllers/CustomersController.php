<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use http\Client;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }


    public function store(Request $request)
    {
        $request->validate(Customer::$rules);

        $input = $request->only('name', 'document','address','phoneNumber','state');

        try {

            Customer::create([
                'name' => $input['name'],
                'document' => $input['document'],
                'address' => $input['address'],
                'phoneNumber' => $input['phoneNumber'],
                'state' => $input['state'],
            ]);

            return redirect('/clientes')->with('success', 'Se registró el cliente correctamente');
        } catch (\Exception $e) {
            return redirect('/clientes/create')->with('error', $e->getMessage());
        }

    }


    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customers.details', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        if ($customer == null) {
            return redirect("/customer")->with('error', 'Cliente no encontrado');
        }

        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
