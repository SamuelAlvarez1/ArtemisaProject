<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Sale;
use Carbon\Carbon;

class ReportsController extends Controller
{

    public function __construct()
    {
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES');
    }

    public function index()
    {
        $condition = "index";
        return view("reports.index", compact("condition"));
    }


    public function bookings($startDate, $finalDate)
    {
        $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName", "users.name as user", "bookings_states.name as stateName")
            ->join("customers", "bookings.idCustomer", "=", "customers.id")
            ->leftJoin('events', 'bookings.idEvent', '=', 'events.id')
            ->join("users", "bookings.idUser", "=", "users.id")
            ->join("bookings_states", "bookings.idState", "=", "bookings_states.id")
            ->whereDate("bookings.created_at", ">=", $startDate)
            ->whereDate("bookings.created_at", "<=", $finalDate)
            ->orderBy("bookings.idState", "asc")
            ->get();

        $condition = "bookings";

        return view("reports.index", compact("bookings", "condition"));
    }

    public function sales($startDate, $finalDate)
    {
        $sales = Sale::select("sales.*", "customers.name as customerName", "users.name as userName")
            ->leftjoin("customers", "sales.idCustomers", "=", "customers.id")
            ->join("users", "sales.idUser", "=", "users.id")
            ->whereDate("sales.created_at", ">=", $startDate)
            ->whereDate("sales.created_at", "<=", $finalDate)
            ->orderBy("sales.state", "asc")
            ->get();

        $condition = "sales";

        return view("reports.index", compact("sales", "condition"));
    }
}
