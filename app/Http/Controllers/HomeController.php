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
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        $Chart = DB::table($data)->select(DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$weekStartDate, $weekEndDate])
            ->groupBy(DB::raw('EXTRACT(DAY from created_at)'))
            ->pluck('count');
        $Week = DB::table($data)->select(DB::raw('date(created_at) as fecha'))
            ->whereBetween('created_at', [$weekStartDate, $weekEndDate])
            ->groupBy(DB::raw('fecha'))
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
        $plateOutStanding = Plate::find($outstandingPlate);
        //Bookings
        $date = Carbon::now()->toDateString();
        $Bookings = Booking::select('id')
            ->whereRaw('Date(created_at) = CURDATE()')
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
        //        Customers
        $FClientes = Sale::selectRaw('count(id) as sales, sales.idCustomers as customers')->where('sales.state', 1)
            ->take(5)
            ->groupBy('customers')
            ->orderBy('sales', 'Desc')
            ->get();
        $customers = [];
        foreach ($FClientes as $key => $cliente) {
            $customers[$key] = Customer::select('name')->where('id', $cliente->customers)->first();
            $customers[$key]['sales'] = $cliente->sales;
        }
        $FPlates = SaleDetail::selectRaw('count(id) as sales, sum(quantity) as quantity,  sales_details.idPlate as plates')
            ->where('idPlate', '!=', 1)
            ->take(5)
            ->groupBy('plates')
            ->orderBy('quantity', 'Desc')
            ->get();

        $plates = [];

        foreach ($FPlates as $key => $plate) {
            $plates[$key] = Plate::all()->where('id', $plate->plates)->first();
            $plates[$key]['sales'] = $plate->sales;
            $plates[$key]['quantity'] = $plate->quantity;
        }
        return view('home', compact('plateOutStanding', 'countBookings', 'countSales', 'salesData', 'bookingsData', 'salesDataWeek', 'bookingsDataWeek', 'customers', 'plates'));
    }
}
