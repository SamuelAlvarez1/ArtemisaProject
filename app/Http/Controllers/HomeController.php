<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\PlateVariation;
use App\Models\Plate;
use App\Models\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $details = SaleDetail::select('sales_details.idVariations', 'plates_variations.idPlate as Plate')
        ->join('plates_variations', 'sales_details.idVariations', '=', 'plates_variations.id')
        ->join('plates', 'plates_variations.idPlate', '=', 'plates.id')
        ->get();

        $idPlate = [];

        foreach ($details as $i => $value) {
            $idPlate[$i] = $value->Plate;

            // echo $value->Plate . "<br>";
        }
        $plates = array_count_values($idPlate);

        $outstandingPlate = 0;

        foreach ($plates as $key => $value) {
            if ($key > $outstandingPlate) {
                $outstandingPlate = $key;
            }
        }

        $plate = Plate::find($outstandingPlate);
        
        
        return view('home', compact('plate'));
    }
}
