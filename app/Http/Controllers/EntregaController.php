<?php

namespace app\Http\Controllers;

use app\Cliente;
use app\DatosUsuario;
use app\Distribuidor;
use app\Entrega;
use app\Orden;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntregaController extends Controller
{
    public function index(Request $request)
    {
        $entregas = Entrega::where('status', 1)
            ->get();
        if (Auth::user()->tipo == 'EMPRESA') {
            $entregas = Entrega::select('entregas.*')
                ->join('ordens', 'ordens.id', '=', 'entregas.orden_id')
                ->where('ordens.empresa_id', Auth::user()->datosUsuario->empresa_id)
                ->where('entregas.status', 1)
                ->get();
        } elseif (Auth::user()->tipo == 'DISTRIBUIDOR') {
            $entregas = Entrega::select('entregas.*')
                ->join('ordens', 'ordens.id', '=', 'entregas.orden_id')
                ->where('ordens.distribuidor_id', Auth::user()->id)
                ->where('entregas.status', 1)
                ->get();
        }

        if ($request->ajax()) {
            $texto = $request->texto;
            $entregas = Entrega::select('entregas.*')
                ->join('ordens', 'ordens.id', '=', 'entregas.orden_id')
                ->join('clientes', 'clientes.id', '=', 'ordens.cliente_id')
                ->join('productos', 'productos.id', '=', 'ordens.producto_id')
                ->where('entregas.status', 1)
                ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.materno, productos.nombre, entregas.estado)'), 'LIKE', "%$texto%")
                ->get();
            if (Auth::user()->tipo == 'EMPRESA') {
                $entregas = Entrega::select('entregas.*')
                    ->join('ordens', 'ordens.id', '=', 'entregas.orden_id')
                    ->join('clientes', 'clientes.id', '=', 'ordens.cliente_id')
                    ->join('productos', 'productos.id', '=', 'ordens.producto_id')
                    ->where('ordens.empresa_id', Auth::user()->datosUsuario->empresa_id)
                    ->where('entregas.status', 1)
                    ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.materno, productos.nombre, entregas.estado)'), 'LIKE', "%$texto%")
                    ->get();
            } elseif (Auth::user()->tipo == 'DISTRIBUIDOR') {
                $entregas = Entrega::select('entregas.*')
                    ->join('ordens', 'ordens.id', '=', 'entregas.orden_id')
                    ->join('clientes', 'clientes.id', '=', 'ordens.cliente_id')
                    ->join('productos', 'productos.id', '=', 'ordens.producto_id')
                    ->where('ordens.distribuidor_id', Auth::user()->id)
                    ->where('entregas.status', 1)
                    ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.materno, productos.nombre, entregas.estado)'), 'LIKE', "%$texto%")
                    ->get();
            }

            $html = view('entregas.parcial.lista', compact('entregas'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }
        return view('entregas.index', compact('entregas'));
    }

    public function create()
    {
        $clientes = Cliente::select('clientes.*')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', 'CLIENTE')
            ->get();

        $array_clientes[''] = 'Seleccione...';
        foreach ($clientes as $value) {
            $array_clientes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        $array_ordens = [];

        return view('entregas.create', compact('array_clientes', 'array_ordens'));
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $request['fecha_hora_entrega'] = date('Y-m-d H:i', strtotime($request->fecha_entrega . ' ' . $request->hora_entrega));
        $request['estado'] = 'PENDIENTE';
        $request['status'] = 1;
        $request['qr'] = 'qr_pagos';
        $nueva_entrega = Entrega::create(array_map('mb_strtoupper', $request->all()));
        /* GENERAR CÓDIGO QR */
        $codigo_qr = $nueva_entrega->cliente->paterno . time() . '.png'; //NOMBRE DE LA IMAGEN QR
        $text_qr = route('entregas.pago_entrega', $nueva_entrega->id);
        $base_64 = base64_encode(\QrCode::format('png')->size(400)->generate($text_qr));
        $imagen_codigo_qr = base64_decode($base_64);
        file_put_contents(public_path() . '/imgs/qr/' . $codigo_qr, $imagen_codigo_qr);

        $orden = Orden::find($nueva_entrega->orden_id);
        $orden->estado = 'ENVIO PENDIENTE';
        $orden->save();

        $nueva_entrega->qr = $codigo_qr;
        $nueva_entrega->save();

        return redirect()->route('entregas.index')->with('bien', 'Registro realizado con éxito')
            ->with('url_qr', route('entregas.qr_pdf', $nueva_entrega->id));
    }

    public function edit(Entrega $entrega)
    {
        $clientes = Cliente::select('clientes.*')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', 'CLIENTE')
            ->get();

        foreach ($clientes as $value) {
            $array_clientes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        $cliente_id = $entrega->cliente_id;
        $ordens = Orden::where('status', 1)
            ->where('cliente_id', $cliente_id)
            ->where('estado', '!=', 'ENTREGADO')
            ->get();
        if (Auth::user()->tipo == 'EMPRESA') {
            $ordens = Orden::where('status', 1)
                ->where('cliente_id', $cliente_id)
                ->where('estado', '!=', 'ENTREGADO')
                ->where('empresa_id', Auth::user()->datosUsuario->empresa_id)
                ->get();
        } elseif (Auth::user()->tipo == 'DISTRIBUIDOR') {
            $ordens = Orden::where('status', 1)
                ->where('cliente_id', $cliente_id)
                ->where('estado', '!=', 'ENTREGADO')
                ->where('distribuidor_id', Auth::user()->id)
                ->get();
        }

        return view('entregas.edit', compact('entrega', 'array_clientes'));
    }

    public function update(Entrega $entrega, Request $request)
    {
        $entrega->update(array_map('mb_strtoupper', $request->all()));
        $entrega->orden->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('entregas.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Entrega $entrega)
    {
        return 'mostrar entrega';
    }

    public function destroy(Entrega $entrega)
    {
        $entrega->orden->update([
            "fecha_entrega" => null,
            "hora_entrega" => null,
            "fecha_hora_entrega" => null,
            "distribuidor_id" => null,
            "estado" => "PENDIENTE"
        ]);
        \File::delete(public_path() . "/imgs/qr/" . $entrega->qr);
        $entrega->delete();
        return redirect()->route('entregas.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function pago_entrega(Entrega $entrega)
    {
        $usuario = $entrega->cliente->user;
        if (Auth::login($usuario)) {
            return view('pago', compact('entrega'));
        }
    }

    public function qr_pdf(Entrega $entrega)
    {
        $pdf = PDF::loadView('entregas.qr_pdf', compact('entrega'))->setPaper('letter', 'portrait');
        $pdf->output();
        return $pdf->stream('QREntrega' . time() . '.pdf');
    }

    public function g_info_entregas(Request $request)
    {
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;
        $empresa = $request->empresa;
        $distribuidor = $request->distribuidor;

        $distribuidors =  DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', '=', 'DISTRIBUIDOR')
            ->orderBy('datos_usuarios.nombre', 'asc')
            ->get();
        if ($distribuidor != 'todos') {
            $distribuidors =  DatosUsuario::select('datos_usuarios.*')
                ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                ->where('users.estado', 1)
                ->where('users.id', $distribuidor)
                ->where('users.tipo', '=', 'DISTRIBUIDOR')
                ->orderBy('datos_usuarios.nombre', 'asc')
                ->get();
        }
        $data = [];
        $total = 0;
        foreach ($distribuidors as $d) {
            $ordens = Orden::where('status', 1)
                ->where('distribuidor_id', $d->user->id)
                ->whereBetween('fecha_registro', [$fecha_ini, $fecha_fin]);
            if ($empresa != 'todos') {
                $ordens->where('empresa_id', $empresa);
            }

            $ordens = $ordens->get();
            $total = (int)$total + (int)count($ordens);
            $data[] = [$d->nombre . ' ' . $d->paterno . ' ' . $d->materno . ' "' . $d->distribuidor->nombre . '"', (int)count($ordens)];
        }
        return response()->JSON([
            'sw' => true,
            'data' => $data,
            'total' => 'TOTAL: ' . $total
        ]);
    }
}
