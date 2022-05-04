<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Event;
use DataTables;
use Carbon\Carbon;

class BookingsController extends Controller
{

    public function __construct()
    {
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES');
    }


    public function index()
    {


        $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName", "users.name as user")
            ->join("customers", "bookings.idCustomer", "=", "customers.id")
            ->leftJoin('events', 'bookings.idEvent', '=', 'events.id')
            ->join("users", "bookings.idUser", "=", "users.id")
            ->where("bookings.state", "=", 1)
            ->get();


        $states = "1";

        return view("bookings.index", compact("bookings", "states"));
    }


    public function seeCanceled()
    {
        $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName", "users.name as user")
            ->join("customers", "bookings.idCustomer", "=", "customers.id")
            ->leftJoin('events', 'bookings.idEvent', '=', 'events.id')
            ->join("users", "bookings.idUser", "=", "users.id")
            ->where("bookings.state", "=", 0)
            ->get();

        foreach ($bookings as $booking) {
            $booking->start_date = Carbon::parse($booking->start_date)->format('d-m-Y h:i a');
        }

        $states = "0";
        return view("bookings.index", compact("bookings", "states"));
    }

    public function seeApproved()
    {
        $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName", "users.name as user")
            ->join("customers", "bookings.idCustomer", "=", "customers.id")
            ->leftJoin('events', 'bookings.idEvent', '=', 'events.id')
            ->join("users", "bookings.idUser", "=", "users.id")
            ->where("bookings.state", "=", 2)
            ->get();

        foreach ($bookings as $booking) {
            $booking->start_date = Carbon::parse($booking->start_date)->format('d-m-Y h:i a');
            $booking->final_date = Carbon::parse($booking->final_date)->format('d-m-Y h:i a');
        }

        $states = "2";
        return view("bookings.index", compact("bookings", "states"));
    }


    public function updateState($id, $state)
    {
        if ($id != null && $state < 3) {

            try {

                $booking = Booking::find($id);

                if ($booking != null && $booking->state != $state) {
                    if ($state == 2) {
                        if ($booking->start_date > Carbon::parse(date("d-m-Y h:i"))) {
                            return redirect('/bookings')->with("error", "Aún no ha llegado la fecha de esta reserva");
                        }
                        $booking->update([
                            "state" => $state,
                            "final_date" => Carbon::parse(date("d-m-Y h:i"))
                        ]);
                    } else {
                        $booking->update([
                            "state" => $state
                        ]);
                    }
                } else {
                    return redirect('/bookings')->with("error", "El cambio de estado de la reserva no se pudo realizar");
                }

                if ($state == 1) {
                    return redirect('/bookings/seeCanceled')->with("success", "cambio de estado exitoso");;
                } else {
                    return redirect('/bookings')->with("success", "cambio de estado exitoso");;
                }
            } catch (\Exception $e) {

                return redirect('/bookings')->with("error", "El cambio de estado de la reserva no se pudo realizar");
            }
        }


        return redirect('/bookings')->with("error", "El cambio de estado de la reserva no se pudo realizar");
    }


    public function create()
    {
        $customers = customer::all();
        $events = Event::all();

        return view("bookings.create", compact('customers', 'events'));
    }

    public function store(Request $request)
    {
        $campos = [
            'idCustomer' => 'required|numeric',
            'amount_people' => 'required|numeric|min:1|max:20',
            'booking_date' => 'required|date|after_or_equal:' . date('d-m-Y'),
            'booking_hour' => 'required|numeric',
            'booking_minutes' => 'required|numeric',
        ];

        $this->validate($request, $campos);

        $start_date = Carbon::parse($request["booking_date"] . " " . $request["booking_hour"] . ":" . $request["booking_minutes"]);


        if (Carbon::now() > Carbon::parse($start_date)) {
            return redirect('/bookings/create')->with("error", "La reserva no se pudo crear debido a que la fecha actual es mayor a la fecha solicitada");
        }



        $bookings = Booking::select("amount_people")
            ->whereDate("start_date", $request['start_date'])
            ->where('state', 1)
            ->get();

        $countPeople = 0;
        foreach ($bookings as $booking) {
            $countPeople += $booking->amount_people;
        }


        if (($countPeople + $request['amount_people']) >= 100) {
            return redirect('/bookings')->with("error", "ya no hay mas reservas disponibles para esa fecha");
        }

        try {
            Booking::create([
                'idCustomer' => $request['idCustomer'],
                'idEvent' =>  $request['idEvent'],
                'idUser' => auth()->user()->id,
                'amount_people' => $request['amount_people'],
                'start_date' => $start_date,
                'state' => 1
            ]);
        } catch (\Exception $e) {
            return redirect('/bookings')->with("error", "La reserva no se pudo crear");
        }



        return redirect("/bookings")->with("success", "reserva creada satisfactoriamente");
    }


    public function show($id)
    {
        if ($id != null) {
            $booking = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName")
                ->join("customers", "bookings.idCustomer", "=", "customers.id")
                ->leftJoin('events', 'bookings.idEvent', '=', 'events.id')
                ->where("bookings.id", "=", $id)
                ->first();

            if ($booking == null) {
                return redirect('/bookings')->with("error", "La reserva no se pudo encontrar");
            }
        }

        return view("bookings.showDetails", compact("booking"));
    }


    public function edit($id)
    {
        if ($id != null) {
            $booking = Booking::find($id);
            if ($booking != null) {
                $customers = Customer::all();
                $events = Event::all();

                return view("bookings.edit", compact("booking", "customers", "events"));
            }
        } else {
            return redirect('/bookings')->with("error", "La reserva no fue encontrada");
        }
        return redirect('/bookings')->with("error", "La reserva no fue encontrada");
    }


    public function update(Request $request, $id)
    {
        if ($id != null) {
            $campos = [
                'idCustomer' => 'required|numeric',
                'amount_people' => 'required|numeric|min:1|max:20',
                'booking_date' => 'required|date|after_or_equal:' . date('d-m-Y'),
                'booking_hour' => 'required|numeric',
                'booking_minutes' => 'required|numeric',
            ];

            $this->validate($request, $campos);

            $start_date = Carbon::parse($request["booking_date"] . " " . $request["booking_hour"] . ":" . $request["booking_minutes"]);


            if (Carbon::now() > Carbon::parse($start_date)) {
                return redirect('/bookings/create')->with("error", "La reserva no se pudo crear debido a que la fecha actual es mayor a la fecha solicitada");
            }



            $bookings = Booking::select("amount_people")
                ->whereDate("start_date", $request['start_date'])
                ->where('state', 1)
                ->get();

            $countPeople = 0;
            foreach ($bookings as $booking) {
                $countPeople += $booking->amount_people;
            }


            if (($countPeople + $request['amount_people']) >= 100) {
                return redirect('/bookings')->with("error", "ya no hay mas reservas disponibles para esa fecha");
            }


            try {
                $booking = Booking::find($id);

                if ($booking != null) {
                    $booking->update([
                        'idCustomer' => $request['idCustomer'],
                        'idEvent' =>  $request['idEvent'],
                        'idUser' => auth()->user()->id,
                        'amount_people' => $request['amount_people'],
                        'start_date' => $start_date,
                    ]);
                }

                return redirect('/bookings')->with("success", "La reserva fue editada satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/bookings')->with("error", 'La reserva no se pudo editar');
            }
        }
        return redirect('/bookings')->with("error", 'La reserva no se pudo editar');
    }


    public function destroy($id)
    {
    }
}
