<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Events;
use DataTables;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("reservas.index");
    }

    public function listar($condicion)
    {


        if ($condicion == "canceladas") {
            $reservas = Booking::select("reservas.*", "customers.name as nombreCliente", "eventos.nombre as nombreEvento")
                ->join("customers", "reservas.idCliente", "=", "customers.id")
                ->join("eventos", "reservas.idEvento", "=", "eventos.id")
                ->where("reservas.estado", "=", 0)
                ->get();
            return DataTables::of($reservas)
                ->editColumn("estado", function ($reserva) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-danger">cancelada</span>'
                        . '</div>';
                })
                ->addColumn("acciones", function ($reserva) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="/reservas/verDetalles/' . $reserva->id . '" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="/reservas/editar/' . $reserva->id . '" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="/reservas/cambiarEstado/enProceso/' . $reserva->id . '/1" class="btn btn-info text-white"><i class="fa-solid fa-clock"></i></a>'
                        . '<a href="/reservas/cambiarEstado/aprobar/' . $reserva->id . '/2" class="btn btn-success text-white"><i class="fas fa-check"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['estado', 'acciones'])
                ->make(true);
        } else if ($condicion == "enProceso") {
            $reservas = Booking::select("reservas.*", "customers.name as nombreCliente", "eventos.nombre as nombreEvento")
                ->join("customers", "reservas.idCliente", "=", "customers.id")
                ->join("eventos", "reservas.idEvento", "=", "eventos.id")
                ->where("reservas.estado", "=", 1)
                ->get();
            return DataTables::of($reservas)
                ->editColumn("estado", function ($reserva) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-warning">En proceso</span>'
                        . '</div>';
                })
                ->addColumn("acciones", function ($reserva) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="/reservas/verDetalles/' . $reserva->id . '" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>'
                        . '<a href="/reservas/editar/' . $reserva->id . '" class="btn btn-warning text-white"><i class="fas fa-edit"></i></a>'
                        . '<a href="/reservas/cambiarEstado/cancelar/' . $reserva->id . '/0" class="btn btn-danger text-white"><i class="fas fa-ban"></i></a>'
                        . '<a href="/reservas/cambiarEstado/aprobar/' . $reserva->id . '/2" class="btn btn-success text-white"><i class="fas fa-check"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['estado', 'acciones'])
                ->make(true);
        } else {
            $reservas = Booking::select("reservas.*", "customers.name as nombreCliente", "eventos.nombre as nombreEvento")
                ->join("customers", "reservas.idCliente", "=", "customers.id")
                ->join("eventos", "reservas.idEvento", "=", "eventos.id")
                ->where("reservas.estado", "=", 2)
                ->get();
            return DataTables::of($reservas)
                ->editColumn("estado", function ($reserva) {
                    return '<div class="d-flex justify-content-center">'
                        . '<span class="badge bg-success">Aprobada</span>'
                        . '</div>';
                })
                ->addColumn("acciones", function ($reserva) {

                    return '<div class="d-flex justify-content-center">'
                        . '<a href="/reservas/verDetalles/' . $reserva->id . '" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>'
                        . '</div>';
                })
                ->rawColumns(['estado', 'acciones'])
                ->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = customer::all();
        $events = Booking::all();

        return view("reservas.crear", compact('clientes', 'eventos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'idCliente' => 'required',
            'idEvento' => 'required',
            'cantidad_personas' => 'required',
            'fecha_fin' => 'required',
        ];

        $mensaje = [
            'required' => 'El campo :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);

        Booking::create([
            'idCliente' => $request['idCliente'],
            'idEvento' =>  $request['idEvento'],
            'cantidad_personas' => $request['cantidad_personas'],
            'fecha_inicio' => date('Y-m-d'),
            'fecha_fin' => $request['fecha_fin'],
            'estado' => 1,
        ]);

        return redirect("/reservas")->with("success", "reserva creada satisfactoriamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reserva = Booking::select("reservas.*", "customer.name as nombreCliente", "eventos.nombre as nombreEvento")
            ->join("customer", "reservas.idCliente", "=", "customer.id")
            ->join("eventos", "reservas.idEvento", "=", "eventos.id")
            ->where("reservas.id", "=", $id)
            ->get();

        foreach ($reserva as $value) {
            $reserva = $value;
        }


        return view("reservas.verDetalles", compact("reserva"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id != null) {
            $reserva = Booking::find($id);
            $clientes = Customer::all();
            $eventos = Events::all();

            return view("reservas.editar", compact("reserva", "clientes", "eventos"));
        } else {
            return redirect('/reservas')->with("error", "el id de la reserva no fue encontrado");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id != null) {
            $campos = [
                'idCliente' => 'required',
                'idEvento' => 'required',
                'cantidad_personas' => 'required',
                'fecha_fin' => 'required',
            ];


            $mensaje = [
                'required' => 'El campo :attribute es requerido',
            ];

            $this->validate($request, $campos, $mensaje);
            try {
                Booking::where("id", "=", $id)->update([
                    'idCliente' => $request['idCliente'],
                    'idEvento' =>  $request['idEvento'],
                    'cantidad_personas' => $request['cantidad_personas'],
                    'fecha_fin' => $request['fecha_fin'],
                ]);
                return redirect('/reservas')->with("edit", "La reserva fue editada satisfactoriamente");
            } catch (\Exception $e) {
                return redirect('/reservas')->with("error", $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $estado)
    {
        if ($id != null) {
            try {
                $reserva = Booking::where("id", "=", $id);
                Booking::where("id", "=", $id)->update([
                    "estado" => $estado
                ]);
                if ($estado == 1) {
                    return redirect('/reservas/verCanceladas')->with("success", "cambio de estado exitoso");
                } else {
                    return redirect('/reservas')->with("success", "cambio de estado exitoso");
                }
            } catch (\Exception $e) {
                return redirect('/reservas')->with("error", "el estado de la reserva no se pudo cambiar");
            }
        }
    }

    public function verCanceladas()
    {
        return view("reservas.verCanceladas");
    }

    public function verAprobadas()
    {
        return view("reservas.verAprobadas");
    }
}
