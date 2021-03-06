<?php

namespace App\Http\Controllers;

use App\Models\Event;
use \App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    const INDEX = '/events';
    const BETWEEN_RANGE = '? BETWEEN startDate and endDate';

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
        $messages = [
            'startDate.after_or_equal' => 'El campo fecha inicio debe ser una fecha posterior o igual a hoy',
        ];
        $validator = Validator::make($request->all(), Event::$rules, $messages);
        $validator->after(function ($validator) use ($request){

            //Eliminar las validaciones con validator a la hora de presentarlo al cliente
            $eventsInsideCreated = $this->getDateRange($request->input('startDate'), $request->input('endDate'));
            if($eventsInsideCreated) {
                $validator->errors()->add('startDate', 'Ya existe un evento en este rango de fechas');
            }
            });
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $image = null;
        $input = $request->only('name', 'description','decorationPrice','entryPrice', 'endDate','startDate');
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
                'image' => $image,
                'state' => 1
            ]);
            return redirect(self::INDEX)->with('success', 'Se registr?? el evento correctamente');
        } catch (\Exception $e) {
            return redirect('/events/create')->with('error', 'No fue posible registrar el evento');
        }
    }

    public function show($id)
    {
        $event = Event::find($id);
        if ($event == null){
            return redirect("/events")->with('error', 'Evento no encontrado');
        }
        $countBookings = Booking::where('idEvent', $id)->count();
        $seatsNeeded = Booking::where('idEvent', $id)->sum('amount_people');
        return view('events.details', compact('event','countBookings', 'seatsNeeded'));
    }

    public function edit($id)
    {
        $event = Event::find($id);
        if ($event == null)  {
            return redirect(self::INDEX)->with('error', 'Evento no encontrado');
        }

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'startDate.after_or_equal' => 'El campo fecha inicio debe ser una fecha posterior o igual a hoy',
        ];
        $validator = Validator::make($request->all(), Event::$rulesUpdate, $messages);
        $validator->after(function ($validator) use ($request, $id){
            $event = Event::where('name', $request->input('name'))->where('id','!=', $id)->first();
            if ($event){
                $validator->errors()->add('name', 'Este nombre ya est?? en uso');
            }
            $eventsInsideCreated = $this->getDateRange($request->input('startDate'), $request->input('endDate'));
            if($eventsInsideCreated && $eventsInsideCreated->id != $id){
                $validator->errors()->add('startDate', 'Ya existe un evento en este rango de fechas');
            }
        });
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $image = null;
        $input = $request->only('name', 'description','decorationPrice','entryPrice', 'endDate','startDate');
        $data = [];
        if ($request->image){
            $event = Event::find($id);
            $this->removeImage($event->image);
            $image = $input['name'].time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'),$image);
            $data = ['image' => $image];
        }
        $data+=[
            'name' => $input['name'],
            'description' => $input['description'],
            'decorationPrice' => $input['decorationPrice'],
            'entryPrice' => $input['entryPrice'],
            'endDate' => $input['endDate'],
            'startDate' => $input['startDate'],
        ];
        try {
            $event = Event::find($id);
            $event->update($data);
            return redirect(self::INDEX)->with('success', 'Se ha editado correctamente la informaci??n');
        } catch (\Exception $e) {
            return redirect('/events/'.$id.'/edit')->with('error', 'No se pudo editar la informaci??n');
        }
    }

    public function updateState($id)
    {
        try {
            $event = Event::find($id);
            $today = date('Y-m-d');
            $yesterday = Carbon::yesterday()->format('Y-m-d');
            if ($event->startDate==$yesterday || $event->startDate==$today) {
                return redirect(self::INDEX)->with('error', 'No es posible cancelar el evento que est?? proximo a ocurrir');
            }
            $event->update(['state' => !$event->state]);
            return redirect(self::INDEX)->with('success', 'Se cambi?? el estado correctamente');
        } catch (\Exception $e) {
            return redirect(self::INDEX)->with('error', 'No fue posible cambiar el estado, intentelo mas tarde');
        }
    }

    public function getDateRange($startDate, $endDate)
    {
        return Event::where('state', 1)
            ->where(function($query) use ($startDate, $endDate){
                $query->whereBetween('startDate', [$startDate,$endDate])
                    ->orWhereBetween('endDate', [$startDate,$endDate])
                    ->orWhereRaw(self::BETWEEN_RANGE, [$startDate])
                    ->orWhereRaw(self::BETWEEN_RANGE, [$endDate]);
            })
            ->first();
    }

    public function removeImage($image)
    {
        if(\File::exists(public_path('uploads/'. $image))){
        \File::delete(public_path('uploads/'. $image));
        }
    }

    public function removeImageAction($id)
    {
        $event = Event::find($id);

        if ($event->image == ''){
            return redirect('/events')->with("error", "Este evento no tiene imagen");
        }
        $this->removeImage($event->image);
        $event->image = '';
        $event->save();
        return redirect('/events')->with("success", "La imagen fue removida satisfactoriamente");
    }
}
