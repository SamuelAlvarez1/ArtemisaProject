<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Rol;
use \App\Models\User;
use \App\Models\Booking;
use Illuminate\Http\Request;

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
                'image' => $image,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

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
        $request->validate(Event::$rules);
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
            'image' => $image,
            'updated_at' => date('Y-m-d H:i:s')
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
            $event->update(['state' => !$event->state]);
            return redirect('/events')->with('success', 'Se cambió el estado correctamente');
        } catch (\Exception $e) {
            return redirect('/events')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        dd("What are you trying, bro?");
    }
}
