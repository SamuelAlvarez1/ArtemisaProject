<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\Models\Event;
use \App\Models\Plate;

class WelcomeController extends Controller
{
    public function index(){      
        $plates = Plate::all()->take(3);
        $events = Event::where('state', 1)
        ->whereRaw('DATE(CURDATE()) >= DATE_SUB(startDate, INTERVAL 6 DAY)')
        ->whereraw('DATE(CURDATE()) <= endDate')
        ->get();
        return view('welcome', compact('plates', 'events'));

    }
}
