<?php

namespace app\Http\Controllers;

use app\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use app\DatosUsuario;
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

        $ordens = Orden::select();
        if ($empresa != 'todos' || $estado != 'todos') {
            if ($empresa != 'todos') {
                $ordens->where('empresa_id', $empresa);
            }
            if ($estado != 'todos') {
                if ($estado == 'PENDIENTE') {
                    $ordens->whereIn('estado', ['PENDIENTE','ENVIO PENDIENTE']);
                } else {
                    $ordens->where('estado', $estado);
                }
            }
        }

        if (Auth::user()->tipo == 'DISTRIBUIDOR') {
            $ordens->where('distribuidor_id', Auth::user()->id);
        }

        $ordens->whereBetween('fecha_registro', [$fecha_ini, $fecha_fin]);
        $ordens->orderBy('fecha_registro', 'desc');
        $ordens = $ordens->get();

        $pdf = PDF::loadView('reportes.ordens', compact('ordens'))->setPaper('letter', 'landscape');
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

        $entregas = Entrega::select('entregas.*')
            ->join('ordens', 'ordens.id', '=', 'entregas.orden_id');
        if ($empresa != 'todos' || $cliente != 'todos') {
            if ($empresa != 'todos') {
                $entregas->where('ordens.empresa_id', $empresa);
            }
            if ($cliente != 'todos') {
                $entregas->where('entregas.cliente_id', $cliente);
            }
        }

        if (Auth::user()->tipo == 'DISTRIBUIDOR') {
            $entregas->where('ordens.distribuidor_id', Auth::user()->id);
        }

        $entregas->whereBetween('entregas.fecha_registro', [$fecha_ini, $fecha_fin]);
        $entregas->orderBy('entregas.fecha_registro', 'desc');
        $entregas = $entregas->get();

        $pdf = PDF::loadView('reportes.entregas', compact('entregas'))->setPaper('letter', 'landscape');
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

        $pagos = Pago::select('pagos.*')
            ->join('entregas', 'entregas.id', '=', 'pagos.entrega_id')
            ->join('ordens', 'ordens.id', '=', 'entregas.orden_id');
        if ($empresa != 'todos') {
            if ($empresa != 'todos') {
                $pagos->where('ordens.empresa_id', $empresa);
            }
        }

        $pagos->whereBetween('pagos.fecha_registro', [$fecha_ini, $fecha_fin]);
        $pagos->orderBy('pagos.fecha_registro', 'desc');
        $pagos = $pagos->get();

        $pdf = PDF::loadView('reportes.pagos', compact('pagos'))->setPaper('letter', 'landscape');
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
