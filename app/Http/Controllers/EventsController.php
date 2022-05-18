<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Event;
use App\Models\Rol;
use \App\Models\User;
use \App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{

    public function index()
    {
        $events = Event::all();
        $states = 'active';
        return view('events.index', compact('events', 'states'));
    }

    public function oldEvents()
    {
        $events = Event::whereDate('endDate', '<', date('Y-m-d'))->get();
        $states = 'false';
        return view('events.index', compact('events', 'states'));
    }

    public function create()
    {
       return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate(Event::$rules);

        $image = null;
        $input = $request->only('name', 'description','decorationPrice','entryPrice','state', 'endDate','startDate');
        if ($request->image){
            $image = $input['name'].time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'),$image);
        }
        try {
            Event::create([
                'name' => $input['name'],
                'description' => $input['description'],
                'decorationPrice' => $input['decorationPrice'],
                'entryPrice' => $input['entryPrice'],
                'idUser' => auth()->user()->id,
                'endDate' => $input['endDate'],
                'startDate' => $input['startDate'],
                'state' => $input['state'],
                'image' => $image

            ]);
            return redirect('/events')->with('success', 'Se registró el evento correctamente');
        } catch (\Exception $e) {
            return redirect('/events/create')->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        $event = Event::find($id);
        if ($event == null)  return redirect("/events")->with('error', 'Evento no encontrado');
        $user = User::find($event->idUser);
        $role = Rol::find($user->idRol);
        $countBookings = Booking::where('idEvent', $id)->count();
        $bookings = Booking::where('idEvent', $id)->get();
        $countSeats = 0;
        foreach ($bookings as $key => $booking) {
            $countSeats += $booking->amount_people;
        }

        return view('events.details', compact('event', 'user','role', 'countBookings', 'countSeats'));
    }


    public function edit($id)
    {
        $event = Event::find($id);
        if ($event == null)  return redirect("/events")->with('error', 'Evento no encontrado');

        return view('events.edit', compact('event'));
    }


    public function update(Request $request, $id)
    {
//        $request->validate(Event::$rulesUpdate);
        $validator = Validator::make($request->all(), Event::$rulesUpdate);
        $validator->after(function ($validator) use ($request, $id){
            $event = Event::where('name', $request->input('name'))->where('id','!=', $id)->first();
            if ($event)
                $validator->errors()->add('name', 'Este nombre ya está en uso');
        });
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $image = null;
        $input = $request->only('name', 'description','decorationPrice','entryPrice','state', 'endDate','startDate');
        if ($request->image){
            $image = $input['name'].time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'),$image);
        }
        $data=[
            'name' => $input['name'],
            'description' => $input['description'],
            'decorationPrice' => $input['decorationPrice'],
            'entryPrice' => $input['entryPrice'],
            'endDate' => $input['endDate'],
            'startDate' => $input['startDate'],
            'state' => $input['state'],
            'image' => $image
        ];
        try {
            $event = Event::find($id);
            $event->update($data);
            return redirect('/events')->with('success', 'Se ha editado correctamente la información');
        } catch (\Exception $e) {
            return redirect('/events/'.$id.'/edit')->with('error', 'No se pudo editar la información');
        }
    }

    public function updateState($id)
    {
        try {
            $event = Event::find($id);
            $today = date('Y-m-d');
            $yesterday = Carbon::yesterday()->format('Y-m-d');
            if ($event->startDate==$yesterday || $event->startDate==$today) {
                return redirect('/events')->with('error', 'No es posible cancelar el evento que está proximo a ocurrir');
            }
            $event->update(['state' => !$event->state]);
            return redirect('/events')->with('success', 'Se cambió el estado correctamente');
        } catch (\Exception $e) {
            return redirect('/events')->with('error', 'No fue posible cambiar el estado, intentelo mas tarde');
        }
    }

    public function destroy($id)
    {
        dd("What are you trying, bro?");
    }
}
