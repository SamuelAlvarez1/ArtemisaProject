<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function index()
    {
        $events = Events::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
       return view('events.create');
    }


    public function store(Request $request)
    {
        $request->validate(Events::$rules);

        $input = $request->only('name', 'description','decorationPrice','entryPrice','state', 'endDate','startDate');

        $input['state'] = 0 ? $input['state'] != 'on' : 1;

        try {

            Events::create([
                'name' => $input['name'],
                'description' => $input['description'],
                'decorationPrice' => $input['decorationPrice'],
                'entryPrice' => $input['entryPrice'],
                'endDate' => $input['endDate'],
                'startDate' => $input['startDate'],
                'state' => $input['state'],
            ]);

            return redirect('/events')->with('success', 'Se registró el evento correctamente');
        } catch (\Exception $e) {
            return redirect('/events/create')->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
