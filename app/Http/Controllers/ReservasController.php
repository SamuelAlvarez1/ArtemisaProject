<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reservas;
use App\Models\clientes;
use App\Models\eventos;
use DataTables;

class ReservasController extends Controller
{
    public function index()
    {
        return view("reservas.index");
    }

    public function listar($condicion)
    {


        if ($condicion == "canceladas") {
            $reservas = reservas::select("reservas.*", "clientes.nombres as nombreCliente", "eventos.nombre as nombreEvento")
                ->join("clientes", "reservas.idCliente", "=", "clientes.id")
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
            $reservas = reservas::select("reservas.*", "clientes.nombres as nombreCliente", "eventos.nombre as nombreEvento")
                ->join("clientes", "reservas.idCliente", "=", "clientes.id")
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
            $reservas = reservas::select("reservas.*", "clientes.nombres as nombreCliente", "eventos.nombre as nombreEvento")
                ->join("clientes", "reservas.idCliente", "=", "clientes.id")
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

    public function crear()
    {
        $clientes = clientes::all();
        $eventos = eventos::all();

        return view("reservas.crear", compact('clientes', 'eventos'));
    }

    public function insertar(Request $request)
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

        reservas::create([
            'idCliente' => $request['idCliente'],
            'idEvento' =>  $request['idEvento'],
            'cantidad_personas' => $request['cantidad_personas'],
            'fecha_inicio' => date('Y-m-d'),
            'fecha_fin' => $request['fecha_fin'],
            'estado' => 1,
        ]);

        return redirect("/reservas")->with("success", "reserva creada satisfactoriamente");
    }

    public function editar($id)
    {
        if ($id != null) {
            $reserva = reservas::find($id);
            $clientes = clientes::all();
            $eventos = eventos::all();

            return view("reservas.editar", compact("reserva", "clientes", "eventos"));
        } else {
            return redirect('/reservas')->with("error", "el id de la reserva no fue encontrado");
        }
    }

    public function actualizar($id, Request $request)
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
                reservas::where("id", "=", $id)->update([
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

    public function cambiarEstado($id, $estado)
    {
        if ($id != null) {
            try {
                $reserva = reservas::where("id", "=", $id);
                reservas::where("id", "=", $id)->update([
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

    public function verDetalles($id)
    {

        $reserva = reservas::select("reservas.*", "clientes.nombres as nombreCliente", "eventos.nombre as nombreEvento")
            ->join("clientes", "reservas.idCliente", "=", "clientes.id")
            ->join("eventos", "reservas.idEvento", "=", "eventos.id")
            ->where("reservas.id", "=", $id)
            ->get();

        foreach ($reserva as $value) {
            $reserva = $value;
        }


        return view("reservas.verDetalles", compact("reserva"));
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
