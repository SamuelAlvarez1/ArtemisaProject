<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index(){
        $now = date('Y-m-d');
        $weekAgo = Carbon::now()->subWeek()->format('Y-m-d');       
        $plates = \App\Models\Plate::all()->take(3);
        $events = \App\Models\Event::where('state', 1)
        ->whereRaw('DATE_SUB(startDate, INTERVAL 7 DAY) >= DATE(CURDATE())')
        ->where('endDate', '>=',$now)
        ->get();
        // dd($weekAgo);
        return view('welcome', compact('plates', 'events'));

    }
}
