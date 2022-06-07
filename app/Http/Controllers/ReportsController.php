<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Sale;
use Carbon\Carbon;
use PDF;

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

        if ($finalDate >= $startDate) {
            $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName", "users.name as user", "bookings_states.name as stateName")
                ->join("customers", "bookings.idCustomer", "=", "customers.id")
                ->leftJoin('events', 'bookings.idEvent', '=', 'events.id')
                ->join("users", "bookings.idUser", "=", "users.id")
                ->join("bookings_states", "bookings.idState", "=", "bookings_states.id")
                ->whereDate("bookings.created_at", ">=", $startDate)
                ->whereDate("bookings.created_at", "<=", $finalDate)
                ->orderBy("bookings.idState", "asc")
                ->get();

            if (count($bookings) > 0) {
                $condition = "bookings";

                $button = '<a class="btn btn-outline-success" href="/reports/bookingsPDF/' . $startDate . '/' . $finalDate . '"' . '>Descargar archivo</a>';

                return view("reports.index", compact("bookings", "condition", "button"));
            }
            return redirect("/reports")->with("error", "No se han encontrado reservas en ese rango de fecha");
        }
        return redirect("/reports")->with("error", "La fecha inicial es mayor a la fecha final, por favor digite correctamente los datos");
    }

    public function sales($startDate, $finalDate)
    {
        if ($finalDate >= $startDate) {
            $sales = Sale::select("sales.*", "customers.name as customerName", "users.name as userName")
                ->leftjoin("customers", "sales.idCustomers", "=", "customers.id")
                ->join("users", "sales.idUser", "=", "users.id")
                ->whereDate("sales.created_at", ">=", $startDate)
                ->whereDate("sales.created_at", "<=", $finalDate)
                ->orderBy("sales.state", "asc")
                ->get();
            if (count($sales) > 0) {
                $condition = "sales";

                $button = '<a class="btn btn-outline-success" href="/reports/salesPDF/' . $startDate . '/' . $finalDate . '"' . '>Descargar archivo</a>';
                return view("reports.index", compact("sales", "condition", "button"));
            }

            return redirect("/reports")->with("error", "No se han encontrado ventas en ese rango de fecha");
        }
        return redirect("/reports")->with("error", "La fecha inicial es mayor a la fecha final, por favor digite correctamente los datos");
    }


    public function bookingsPDF($startDate, $finalDate)
    {
        if ($finalDate >= $startDate) {
            $bookings = Booking::select("bookings.*", "customers.name as customerName", "events.name as eventName", "users.name as user", "bookings_states.name as stateName")
                ->join("customers", "bookings.idCustomer", "=", "customers.id")
                ->leftJoin('events', 'bookings.idEvent', '=', 'events.id')
                ->join("users", "bookings.idUser", "=", "users.id")
                ->join("bookings_states", "bookings.idState", "=", "bookings_states.id")
                ->whereDate("bookings.created_at", ">=", $startDate)
                ->whereDate("bookings.created_at", "<=", $finalDate)
                ->orderBy("bookings.idState", "asc")
                ->get();

            if (count($bookings) > 0) {
                $bookingsCanceled = 0;
                $bookingsInProcess = 0;
                $bookingsApproved = 0;

                foreach ($bookings as  $booking) {
                    if ($booking->idState == 1) {
                        $bookingsCanceled++;
                    } else if ($booking->idState == 2) {
                        $bookingsInProcess++;
                    } else {
                        $bookingsApproved++;
                    }
                }

                $pdf = PDF::loadView("reports.bookingsPDF", ['bookings' => $bookings, "bookingsCanceled" => $bookingsCanceled, "bookingsInProcess" => $bookingsInProcess, "bookingsApproved" => $bookingsApproved]);

                return $pdf->download("reporte_de_reservas.pdf");
            }
            return redirect("/reports")->with("error", "No se han encontrado reservas en ese rango de fecha");
        }
        return redirect("/reports")->with("error", "La fecha inicial es mayor a la fecha final, por favor digite correctamente los datos");
    }

    public function salesPDF($startDate, $finalDate)
    {
        if ($finalDate >= $startDate) {
            $sales = Sale::select("sales.*", "customers.name as customerName", "users.name as userName")
                ->leftjoin("customers", "sales.idCustomers", "=", "customers.id")
                ->join("users", "sales.idUser", "=", "users.id")
                ->whereDate("sales.created_at", ">=", $startDate)
                ->whereDate("sales.created_at", "<=", $finalDate)
                ->orderBy("sales.state", "asc")
                ->get();
            if (count($sales) > 0) {

                $salesCanceled = 0;
                $salesActived = 0;


                foreach ($sales as  $sale) {
                    if ($sale->state == 0) {
                        $salesCanceled++;
                    } else {
                        $salesActived++;
                    }
                }
                $pdf = PDF::loadView("reports.salesPDF", ['sales' => $sales, "salesCanceled" => $salesCanceled, "salesActived" => $salesActived]);

                return $pdf->download("reporte_de_ventas.pdf");
            }

            return redirect("/reports")->with("error", "No se han encontrado ventas en ese rango de fecha");
        }
        return redirect("/reports")->with("error", "La fecha inicial es mayor a la fecha final, por favor digite correctamente los datos");
    }
}
