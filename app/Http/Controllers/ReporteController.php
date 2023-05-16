<?php

namespace app\Http\Controllers;

use app\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use app\DatosUsuario;
use app\DetalleOrden;
use app\Empresa;
use app\Entrega;
use app\Orden;
use app\Pago;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        $array_empresas['todos'] = 'Todos';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }

        $clientes = Cliente::select('clientes.*')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', 'CLIENTE')
            ->get();
        $array_clientes['todos'] = 'Todos';
        foreach ($clientes as $value) {
            $array_clientes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        return view('reportes.index', compact('array_empresas', 'array_clientes'));
    }

    public function usuarios(Request $request)
    {
        $filtro = $request->filtro;
        $tipo = $request->tipo;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', '!=', 'CLIENTE')
            ->orderBy('datos_usuarios.nombre', 'ASC')
            ->get();

        if ($filtro != 'todos') {

            switch ($filtro) {
                case 'tipo':
                    if ($tipo != 'todos') {
                        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
                            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                            ->where('users.estado', 1)
                            ->where('users.tipo', $tipo)
                            ->orderBy('datos_usuarios.nombre', 'ASC')
                            ->get();
                    }
                    break;
                case 'fecha':
                    $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
                        ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                        ->where('users.estado', 1)
                        ->whereBetween('datos_usuarios.fecha_registro', [$fecha_ini, $fecha_fin])
                        ->orderBy('datos_usuarios.nombre', 'ASC')
                        ->get();
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Usuarios.pdf');
    }

    public function ordens(Request $request)
    {
        $empresa = $request->empresa;
        $estado = $request->estado;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $detalle_ordens = DetalleOrden::select("detalle_ordens.*")
            ->join("ordens", "ordens.id", "=", "detalle_ordens.orden_id");
        if ($empresa != 'todos' || $estado != 'todos') {
            if ($empresa != 'todos') {
                $detalle_ordens->where('empresa_id', $empresa);
            }
            if ($estado != 'todos') {
                if ($estado == 'PENDIENTE') {
                    $detalle_ordens->whereIn('ordens.estado', ['PENDIENTE', 'EN CAMINO']);
                } else {
                    $detalle_ordens->where('ordens.estado', $estado);
                }
            }
        }

        if (Auth::user()->tipo == 'DISTRIBUIDOR') {
            $detalle_ordens->where('ordens.distribuidor_id', Auth::user()->id);
        }

        $detalle_ordens->whereBetween('ordens.fecha_registro', [$fecha_ini, $fecha_fin]);
        $detalle_ordens->orderBy('ordens.fecha_registro', 'desc');
        $detalle_ordens = $detalle_ordens->get();

        $pdf = PDF::loadView('reportes.ordens', compact('detalle_ordens'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream('Ordenes.pdf');
    }

    public function entregas(Request $request)
    {
        $empresa = $request->empresa;
        $cliente = $request->cliente;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $detalle_ordens = DetalleOrden::select('detalle_ordens.*')
            ->join('entregas', 'entregas.id', '=', 'detalle_ordens.entrega_id')
            ->join('ordens', 'ordens.id', '=', 'detalle_ordens.orden_id');
        if ($empresa != 'todos' || $cliente != 'todos') {
            if ($empresa != 'todos') {
                $detalle_ordens->where('detalle_ordens.empresa_id', $empresa);
            }
            if ($cliente != 'todos') {
                $detalle_ordens->where('entregas.cliente_id', $cliente);
            }
        }

        if (Auth::user()->tipo == 'DISTRIBUIDOR') {
            $detalle_ordens->where('ordens.distribuidor_id', Auth::user()->id);
        }

        $detalle_ordens->whereBetween('entregas.fecha_registro', [$fecha_ini, $fecha_fin]);
        $detalle_ordens->orderBy('entregas.fecha_registro', 'desc');
        $detalle_ordens = $detalle_ordens->get();
        $pdf = PDF::loadView('reportes.entregas', compact('detalle_ordens'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream('Entregas.pdf');
    }

    public function pagos(Request $request)
    {
        $empresa = $request->empresa;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $detalle_ordens = DetalleOrden::select('detalle_ordens.*')
            ->join('entregas', 'entregas.id', '=', 'detalle_ordens.entrega_id')
            ->join('pagos', 'pagos.entrega_id', '=', 'entregas.id');
        if ($empresa != 'todos') {
            if ($empresa != 'todos') {
                $detalle_ordens->where('detalle_ordens.empresa_id', $empresa);
            }
        }

        $detalle_ordens->whereBetween('pagos.fecha_registro', [$fecha_ini, $fecha_fin]);
        $detalle_ordens->orderBy('pagos.fecha_registro', 'desc');
        $detalle_ordens = $detalle_ordens->get();

        $pdf = PDF::loadView('reportes.pagos', compact('detalle_ordens'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream('IngresoPagos.pdf');
    }
}
