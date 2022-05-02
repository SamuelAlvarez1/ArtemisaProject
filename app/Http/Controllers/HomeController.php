<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
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


    private function Mes($data)
    {
        $Chart = DB::table($data)->select(DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

        $Months = DB::table($data)->select(DB::raw('Month(created_at) as month'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');
        $Data = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($Months as $index => $month) {
            $Data[$month - 1] = $Chart[$index];
        }
        return $Data;
    }



    private function Semana($data)
    {

        $Chart = DB::table($data)->select(DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

        $Week = DB::table($data)->select(DB::raw('date((created_at)) as fecha'))
            ->whereBetween('created_at', [$weekStartDate, $weekEndDate])
            ->get();


        $Data = array(0, 0, 0, 0, 0, 0, 0);
        foreach ($Week as $index => $week) {
            $semana = new Carbon($week->fecha);

            $Data[$semana->dayOfWeek - 1] = $Chart[$index];
        }
        return $Data;
    }



    public function index()
    {
        //Plates

        $Plates = SaleDetail::select('sales_details.idPlate', 'plates.id as Plate')
            ->join('plates', 'sales_details.idPlate', '=', 'plates.id')
            ->get();

        $idPlate = [];

        foreach ($Plates as $i => $value) {
            $idPlate[$i] = $value->Plate;
        }
        $plates = array_count_values($idPlate);


        $outstandingPlate = 0;

        foreach ($plates as $key => $value) {
            if ($value > $outstandingPlate) {
                $outstandingPlate = $key;
            }
        }

        $plate = Plate::find($outstandingPlate);

        //Bookings
        $date = Carbon::now()->toDateString();

        $Bookings = Booking::select('id')
            ->where('start_date', $date)
            ->get();
        $countBookings = sizeof($Bookings);

        //sales

        $Sales = Sale::whereRaw('Date(created_at) = CURDATE()')->get();

        $countSales = sizeof($Sales);


        //        Charts

        $salesData = $this->Mes('sales');
        $bookingsData = $this->Mes('bookings');

        $salesDataWeek = $this->Semana('sales');
        $bookingsDataWeek = $this->Semana('bookings');


        return view('home', compact('plate', 'countBookings', 'countSales', 'salesData', 'bookingsData', 'salesDataWeek', 'bookingsDataWeek'));
    }
}
