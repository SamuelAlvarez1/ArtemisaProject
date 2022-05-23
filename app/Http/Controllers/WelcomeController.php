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
        $Plates = SaleDetail::select('sales_details.idPlate', 'plates.id as Plate')
            ->join('plates', 'sales_details.idPlate', '=', 'plates.id')
            ->get();
        $idPlate = [];
        foreach ($Plates as $i => $value) {
            $idPlate[$i] = $value->Plate;
        }
        $plates = array_count_values($idPlate);

        $outstandingsPlates = [];

        foreach($plates as $key => $plate){
            $outstandingsPlates[$key] = Plate::where('id', $key)->pluck('name', 'image', 'price');
        }

//    dd($outstandingsPlates);

        $events = Event::where('state', 1)
        ->whereRaw('DATE(CURDATE()) >= DATE_SUB(startDate, INTERVAL 6 DAY)')
        ->whereraw('DATE(CURDATE()) <= endDate')
        ->get();
        return view('welcome', compact('outstandingsPlates', 'events'));

    }
}
