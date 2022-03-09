<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use http\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomersController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

//    public function list(){
//        $customer = Customer::all();
//        return DataTables::of($customer)
//            ->editColumn("state", function ($customer) {
//                return $customer->estado == 1 ? "Activo" : "Inactivo";
//            })
//            ->addColumn('edit', function ($customer) {
//                return '
//                        <form method="post" action="/customer/'.$customer->id.'">
//                        '.csrf_field().'
//                        <button type="button" class="btn-sm btn btn-primary"> <a href="/clientes/edit/' . $customer->id . '"><i class="fas text-white fa-edit"></i></a> </button>
//                        <button type="button" class="btn-sm btn btn-warning"> <a href="/clientes/details/' . $customer->id . '"><i class="fas text-white fa-info-circle"></i></a> </button>
//                        </form>
//';
//            })
//            ->addColumn('change', function ($customer) {
//                if ($customer->estado == 1) {
//                    return '<a class="btn btn-danger bt-sm" href="/customer' . $customer->id . '/0"><i class="fas fa-ban"></i></a>';
//                } else {
//                    return '<a class="btn btn-success bt-sm" href="/customer' . $customer->id . '/1"><i class="far fa-check-circle"></i></a>';
//                }
//            })
//            ->rawColumns(['edit', 'change'])
//            ->make(true);
//    }
//

    public function create()
    {
        return view('customers.create');
    }


    public function store(Request $request)
    {
        $request->validate(Customer::$rules);

        $input = $request->only('name', 'document','address','phoneNumber','state');

        $input['state'] = 0 ? $input['state'] != 'on' : 1;

        try {

            Customer::create([
                'name' => $input['name'],
                'document' => $input['document'],
                'address' => $input['address'],
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
    //        return view('customers.details', compact('customer'));
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
