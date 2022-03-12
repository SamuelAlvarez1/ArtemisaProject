<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Events;
use DataTables;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName")
            ->join("customers", "bookings.idCustomer", "=", "customers.id")
            ->join("events", "bookings.idEvent", "=", "events.id")
            ->where("bookings.state", "=", 1)
            ->get();

        $states = "1";
        return view("bookings.index", compact("bookings", "states"));
    }


    public function seeCanceled()
    {
        $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName")
            ->join("customers", "bookings.idCustomer", "=", "customers.id")
            ->join("events", "bookings.idEvent", "=", "events.id")
            ->where("bookings.state", "=", 0)
            ->get();

        $states = "0";
        return view("bookings.index", compact("bookings", "states"));
    }

    public function seeApproved()
    {
        $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName")
            ->join("customers", "bookings.idCustomer", "=", "customers.id")
            ->join("events", "bookings.idEvent", "=", "events.id")
            ->where("bookings.state", "=", 2)
            ->get();

        $states = "2";
        return view("bookings.index", compact("bookings", "states"));
    }


    public function updateState($id, $state)
    {
        if ($id != null) {
            try {
                Booking::where("id", "=", $id)->update([
                    "state" => $state
                ]);
                if ($state == 1) {
                    return redirect('/bookings/seeCanceled')->with("success", "cambio de estado exitoso");;
                } else {
                    return redirect('/bookings')->with("success", "cambio de estado exitoso");;
                }
            } catch (\Exception $e) {
                return redirect('/bookings')->with("error", "El estado de la reserva no se pudo realizar");
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = customer::all();
        $events = Events::all();

        return view("bookings.create", compact('customers', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'idCustomer' => 'required',
            'idEvent' => 'required',
            'amount_people' => 'required',
            'final_date' => 'required',
        ];

        $mensaje = [
            'required' => 'El campo :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);

        Booking::create([
            'idCustomer' => $request['idCustomer'],
            'idEvent' =>  $request['idEvent'],
            'amount_people' => $request['amount_people'],
            'start_date' => date('Y-m-d'),
            'final_date' => $request['final_date'],
            'state' => 1,
        ]);

        return redirect("/bookings")->with("success", "reserva creada satisfactoriamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::select("bookings.*", "customer.name as customerName", "events.name as eventName")
            ->join("customer", "bookings.idCustomer", "=", "customer.id")
            ->join("events", "bookings.idEvent", "=", "events.id")
            ->where("bookings.id", "=", $id)
            ->get();

        foreach ($booking as $value) {
            $booking = $value;
        }


        return view("booking.showDetails", compact("booking"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id != null) {
            $booking = Booking::find($id);
            $customers = Customer::all();
            $events = Events::all();

            return view("booking.edit", compact("booking", "customers", "events"));
        } else {
            return redirect('/bookings')->with("error", "el id de la reserva no fue encontrado");
        }
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
        if ($id != null) {
            $campos = [
                'idCustomer' => 'required',
                'idEvent' => 'required',
                'amount_people' => 'required',
                'final_date' => 'required',
            ];


            $mensaje = [
                'required' => 'El campo :attribute es requerido',
            ];

            $this->validate($request, $campos, $mensaje);
            try {
                Booking::where("id", "=", $id)->update([
                    'idCustomer' => $request['idCustomer'],
                    'idEvent' =>  $request['idEvent'],
                    'amount_people' => $request['amount_people'],
                    'final_date' => $request['final_date'],
                ]);
                return redirect('/bookings')->with("edit", "La reserva fue editada satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/bookings')->with("error", $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $estado)
    {
        if ($id != null) {
            try {
                $booking = Booking::where("id", "=", $id);
                Booking::where("id", "=", $id)->update([
                    "state" => $estado
                ]);
                if ($estado == 1) {
                    return redirect('/bookings/seeCanceled')->with("success", "cambio de estado exitoso");
                } else {
                    return redirect('/bookings')->with("success", "cambio de estado exitoso");
                }
            } catch (\Exception $e) {
                return redirect('/bookings')->with("error", "el estado de la reserva no se pudo cambiar");
            }
        }
    }

    public function verCanceladas()
    {
        return view("bookings.seeCanceled");
    }

    public function verAprobadas()
    {
        return view("bookings.seeApproved");
    }
}
