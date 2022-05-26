<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\Models\Event;
use \App\Models\Plate;

class WelcomeController extends Controller
{
    public function index(){
        $FPlates = SaleDetail::selectRaw('count(id) as sales, sum(quantity) as quantity,  sales_details.idPlate as plates')
        ->where('idPlate', '!=', 1)
            ->take(4)
            ->groupBy('plates')
            ->orderBy('quantity', 'Desc')
            ->get();
        $plates = [];
        
        foreach ($FPlates as $key => $plate){
            $plates[$key] = Plate::all()->where('id', $plate->plates)->first();
            $plates[$key]['sales'] = $plate->sales;
            $plates[$key]['quantity'] = $plate->quantity;
        }

        $events = Event::where('state', 1)
        ->whereRaw('DATE(CURDATE()) >= DATE_SUB(startDate, INTERVAL 6 DAY)')
        ->whereraw('DATE(CURDATE()) <= endDate')
        ->get();
        return view('welcome', compact( 'events', 'plates'));

    }
}
