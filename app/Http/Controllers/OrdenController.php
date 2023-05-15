<?php

namespace app\Http\Controllers;

use app\Cliente;
use app\DatosUsuario;
use app\DetalleOrden;
use app\Distribuidor;
use app\Orden;
use app\Producto;
use app\Empresa;
use app\Entrega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
{
    public function index(Request $request)
    {
        $ordens = Orden::where('status', 1)
            ->get();
        if (Auth::user()->tipo == 'EMPRESA') {
            $ordens = Orden::where('status', 1)
                ->where('empresa_id', Auth::user()->datosUsuario->empresa_id)
                ->get();
        } elseif (Auth::user()->tipo == 'DISTRIBUIDOR') {
            $ordens = Orden::where('status', 1)
                ->where('distribuidor_id', Auth::user()->id)
                ->get();
        } elseif (Auth::user()->tipo == 'CLIENTE') {
            $ordens = Orden::where('status', 1)
                ->where('cliente_id', Auth::user()->cliente->id)
                ->get();
        }

        if ($request->ajax()) {
            $texto = $request->texto;
            $ordens = Orden::select('ordens.*')
                ->join('clientes', 'clientes.id', '=', 'ordens.cliente_id')
                ->where('ordens.status', 1)
                ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.materno, ordens.estado)'), 'LIKE', "%$texto%")
                ->get();
            if (Auth::user()->tipo == 'EMPRESA') {
                $ordens = Orden::select('ordens.*')
                    ->join('clientes', 'clientes.id', '=', 'ordens.cliente_id')
                    ->where('ordens.status', 1)
                    ->where('empresa_id', Auth::user()->datosUsuario->empresa_id)
                    ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.materno, ordens.estado)'), 'LIKE', "%$texto%")
                    ->get();
            } elseif (Auth::user()->tipo == 'DISTRIBUIDOR') {
                $ordens = Orden::select('ordens.*')
                    ->join('clientes', 'clientes.id', '=', 'ordens.cliente_id')
                    ->where('ordens.status', 1)
                    ->where('distribuidor_id', Auth::user()->id)
                    ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.materno, ordens.estado)'), 'LIKE', "%$texto%")
                    ->get();
            } elseif (Auth::user()->tipo == 'CLIENTE') {
                $ordens = Orden::select('ordens.*')
                    ->join('clientes', 'clientes.id', '=', 'ordens.cliente_id')
                    ->where('ordens.status', 1)
                    ->where('cliente_id', Auth::user()->cliente->id)
                    ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.materno, ordens.estado)'), 'LIKE', "%$texto%")
                    ->get();
            }

            $html = view('ordens.parcial.lista', compact('ordens'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }
        return view('ordens.index', compact('ordens'));
    }

    public function create()
    {
        $empresas = Empresa::all();

        $clientes = Cliente::select('clientes.*')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', 'CLIENTE')
            ->orderBy('clientes.nombre', 'asc')
            ->get();
        if (Auth::user()->tipo == 'EMPRESA') {
            $clientes = Cliente::select('clientes.*')
                ->join('users', 'users.id', '=', 'clientes.user_id')
                ->where('users.estado', 1)
                ->where('users.tipo', 'CLIENTE')
                ->where('clientes.empresa_id', Auth::user()->datosUsuario->empresa_id)
                ->orderBy('clientes.nombre', 'asc')
                ->get();
        }

        $distribuidors =  DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', '=', 'DISTRIBUIDOR')
            ->orderBy('datos_usuarios.nombre', 'asc')
            ->get();

        $array_empresas[''] = 'Seleccione...';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }

        $array_productos = [];
        if (Auth::user()->tipo == 'EMPRESA') {
            $productos = Producto::where('estado', 1)
                ->where('empresa_id', Auth::user()->datosUsuario->empresa_id)->get();
            $array_productos[''] = 'Seleccione...';
            foreach ($productos as $value) {
                $array_productos[$value->id] = $value->nombre;
            }
        }

        $array_clientes[''] = 'Seleccione...';
        foreach ($clientes as $value) {
            $array_clientes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        $array_distribuidors[''] = 'Seleccione...';
        foreach ($distribuidors as $value) {
            $array_distribuidors[$value->user->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno . ' - "' . $value->distribuidor->nombre . '"';
        }

        return view('ordens.create', compact('array_empresas', 'array_productos', 'array_clientes', 'array_distribuidors'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $fecha_atual = date("Y-m-d");
            $hora_atual = date("H:i:s");
            $nro_orden = 1;
            $ultimo_registro = Orden::where('status', 1)->orderBy('nro_orden', 'asc')->get()->last();
            if ($ultimo_registro) {
                $nro_orden = (int)$ultimo_registro->nro_orden + 1;
            }

            $datos_orden = [
                "nro_orden" => $nro_orden,
                "cliente_id" => $request->cliente["id"],
                "fecha_pedido" => $fecha_atual,
                "hora_pedido" => $hora_atual,
                "fecha_hora_pedido" => date('Y-m-d H:i', strtotime($fecha_atual . ' ' . $hora_atual)),
                "total" => $request->total,
                "estado" => "PENDIENTE",
                "fecha_registro" => $fecha_atual,
                "status" => 1
            ];

            $nueva_orden = Orden::create(array_map('mb_strtoupper', $datos_orden));

            $lista_productos = $request->productos;
            $total = 0;
            foreach ($lista_productos as $lp) {
                $producto = Producto::find($lp["producto_id"]);
                $subtotal = (float)$producto->precio * (float)$lp["cantidad"];
                $nueva_orden->detalle_ordens()->create([
                    "producto_id" => $producto->id,
                    "precio" => $producto->precio,
                    "cantidad" => $lp["cantidad"],
                    "subtotal" => $subtotal
                ]);
                $total += $subtotal;
            }
            $nueva_orden->total = $total;
            $nueva_orden->save();
            DB::commit();
            return response()->JSON([
                "sw" => true,
                "message" => "Registro realizado con éxito",
                "orden" => $nueva_orden
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                "sw" => false,
                "message" => $e->getMessage()
            ], 500);
        }

        // return redirect()->route('ordens.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Orden $orden)
    {
        $empresas = Empresa::all();
        $productos = Producto::where('estado', 1)
            ->where('empresa_id', $orden->empresa_id)->get();
        $clientes = Cliente::select('clientes.*')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', 'CLIENTE')
            ->get();

        $distribuidors =  DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', '=', 'DISTRIBUIDOR')
            ->orderBy('datos_usuarios.nombre', 'asc')
            ->get();

        $array_empresas[''] = 'Seleccione...';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }

        $array_productos[''] = 'Seleccione...';
        foreach ($productos as $value) {
            $array_productos[$value->id] = $value->nombre;
        }

        $array_clientes[''] = 'Seleccione...';
        foreach ($clientes as $value) {
            $array_clientes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        $array_distribuidors[''] = 'Seleccione...';
        foreach ($distribuidors as $value) {
            $array_distribuidors[$value->user->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno . ' - "' . $value->distribuidor->nombre . '"';
        }

        return view('ordens.edit', compact('orden', 'array_empresas', 'array_productos', 'array_clientes', 'array_distribuidors'));
    }

    public function update(Orden $orden, Request $request)
    {
        $request->validate([
            "distribuidor_id" => "required",
            "fecha_entrega" => "required|date",
            "hora_entrega" => "required|date_format:H:i"
        ]);
        DB::beginTransaction();
        try {
            $request["estado"] = "EN CAMINO";
            $request['fecha_hora_entrega'] = date('Y-m-d H:i', strtotime($request->fecha_entrega . ' ' . $request->hora_entrega));
            $orden->update(array_map('mb_strtoupper', $request->all()));

            if (!$orden->entrega) {
                $datos_entrega = [
                    "cliente_id" => $orden->cliente_id,
                    "orden_id" => $orden->id,
                    "qr" => "qr_pagos",
                    "fecha_entrega" => $request["fecha_entrega"],
                    "hora_entrega" => $request["hora_entrega"],
                    "fecha_hora_entrega" => $request["fecha_hora_entrega"],
                    "estado" => $request["estado"],
                    "fecha_registro" => date("Y-m-d"),
                    "status" => 1,
                ];
                $nueva_entrega = Entrega::create($datos_entrega);
                /* GENERAR CÓDIGO QR */
                $codigo_qr = $nueva_entrega->cliente->paterno . time() . '.png'; //NOMBRE DE LA IMAGEN QR
                $text_qr = route('entregas.pago_entrega', $nueva_entrega->id);
                $base_64 = base64_encode(\QrCode::format('png')->size(400)->generate($text_qr));
                $imagen_codigo_qr = base64_decode($base_64);
                file_put_contents(public_path() . '/imgs/qr/' . $codigo_qr, $imagen_codigo_qr);
                $nueva_entrega->qr = $codigo_qr;
                $nueva_entrega->save();
            } else {
                $datos_entrega = [
                    "fecha_entrega" => $request["fecha_entrega"],
                    "hora_entrega" => $request["hora_entrega"],
                    "fecha_hora_entrega" => $request["fecha_hora_entrega"],
                ];
                $orden->entrega->update($datos_entrega);
            }
            DB::commit();
            return redirect()->route('ordens.index')->with('bien', 'Registro modificado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('ordens.index')->with('error', $e->getMessage());
        }
    }

    public function show(Orden $orden)
    {
        $empresas = Empresa::all();
        $productos = Producto::where('estado', 1)->get();
        return view("ordens.show", compact("orden", "empresas", "productos"));
    }

    public function actualizarOrden(Orden $orden, Request $request)
    {
        DB::beginTransaction();
        try {
            $lista_eliminados = $request->eliminados;
            if ($lista_eliminados) {
                foreach ($lista_eliminados as $le) {
                    $detalle_orden = DetalleOrden::findOrFail($le);
                    $detalle_orden->delete();
                }
            }
            $lista_productos = $request->productos;
            $total = 0;
            foreach ($lista_productos as $lp) {
                if ($lp["id"] == 0) {
                    $producto = Producto::find($lp["producto_id"]);
                    $subtotal = (float)$producto->precio * (float)$lp["cantidad"];
                    $orden->detalle_ordens()->create([
                        "producto_id" => $producto->id,
                        "precio" => $producto->precio,
                        "cantidad" => $lp["cantidad"],
                        "subtotal" => $subtotal
                    ]);
                    $total += $subtotal;
                }
            }
            $orden->total = $total;
            $orden->save();
            DB::commit();
            return response()->JSON([
                "sw" => true,
                "message" => "Registro actualizado con éxito",
                "orden" => $orden
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                "sw" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Orden $orden)
    {
        $orden->status = 0;
        $orden->save();
        return redirect()->route('ordens.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function cliente_ordens(Request $request)
    {
        $cliente_id = $request->cliente_id;
        $sw = $request->sw;
        if ($sw == 'create') {
            $ordens = Orden::where('status', 1)
                ->where('cliente_id', $cliente_id)
                ->where('estado', 'PENDIENTE')
                ->get();
            if (Auth::user()->tipo == 'EMPRESA') {
                $ordens = Orden::where('status', 1)
                    ->where('cliente_id', $cliente_id)
                    ->where('estado', 'PENDIENTE')
                    ->where('empresa_id', Auth::user()->datosUsuario->empresa_id)
                    ->get();
            } elseif (Auth::user()->tipo == 'DISTRIBUIDOR') {
                $ordens = Orden::where('status', 1)
                    ->where('cliente_id', $cliente_id)
                    ->where('estado', 'PENDIENTE')
                    ->where('distribuidor_id', Auth::user()->id)
                    ->get();
            }
        } else {
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
        }

        $options = '<option value="">Seleccione...</option>';
        foreach ($ordens as $value) {
            $options .= '<option value="' . $value->id . '">' . 'Orden nro. ' . $value->nro_orden . ' | ' . $value->producto->nombre . ' (' . $value->cantidad . ') | ' . 'Empresa ' . $value->empresa->nombre . ' | ' . 'Distribuidor ' . $value->distribuidor->datosUsuario->nombre . ' ' . $value->distribuidor->datosUsuario->paterno . ' ' . $value->distribuidor->datosUsuario->materno . ' - "' . $value->distribuidor->datosUsuario->distribuidor->nombre . '"</option>';
        }

        return response()->JSON($options);
    }
}
