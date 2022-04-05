<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\PlateVariation;
use App\Models\Plate;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        //Plates

        // $Plates = SaleDetail::select('sales_details.idVariations', 'plates_variations.idPlate as Plate')
        // ->join('plates_variations', 'sales_details.idVariations', '=', 'plates_variations.id')
        // ->join('plates', 'plates_variations.idPlate', '=', 'plates.id')
        // ->get();

        // $idPlate = [];

        // foreach ($Plates as $i => $value) {
        //     $idPlate[$i] = $value->Plate;
        // }
        // $plates = array_count_values($idPlate);

        // $outstandingPlate = 0;

        // foreach ($plates as $key => $value) {
        //     if ($value > $outstandingPlate) {
        //         $outstandingPlate = $key;
        //     }
        // }

        // $plate = Plate::find($outstandingPlate);

        //Bookings
        $date = Carbon::now()->toDateString();

        $Bookings = Booking::select('id')
            ->where('start_date', $date)
            ->get();
        $countBookings = sizeof($Bookings);

        $customers = Customer::select('customers.*')->get();
        $countCustomers = sizeof($Bookings);



        //        Charts

        $salesChart = Sale::select(DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

        $salesMonths = Sale::select(DB::raw('Month(created_at) as month'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');
        $salesData = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($salesMonths as $index => $month) {
            $salesData[$month - 1] = $salesChart[$index];
        }

        $bookingsChart = Booking::select(DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

        $bookingsMonths = Booking::select(DB::raw('Month(created_at) as month'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');
        $bookingsData = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($bookingsMonths as $index => $month) {
            $bookingsData[$month - 1] = $bookingsChart[$index];
        }

        // return view('home', compact('plate', 'countBookings', 'countCustomers', 'salesData', 'bookingsData'));
        return view('home', compact('countBookings', 'countCustomers', 'salesData', 'bookingsData'));
    }
}
