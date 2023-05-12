<?php

namespace app\Http\Controllers;

use app\Empresa;
use app\Entrega;
use app\Pago;
use app\RazonSocial;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::all();
        if (Auth::user()->tipo == 'EMPRESA') {
            $pagos = Pago::select('pagos.*')
                ->join('entregas', 'entregas.id', '=', 'pagos.entrega_id')
                ->join('ordens', 'ordens.id', '=', 'entregas.orden_id')
                ->where('ordens.empresa_id', Auth::user()->datosUsuario->empresa_id)
                ->get();
        }
        return view('pagos.index', compact('pagos'));
    }

    public function show(Pago $pago)
    {
        return view('pagos.show', compact('pago'));
    }

    public function store(Request $request, Entrega $entrega)
    {
        $comprueba = Pago::where('entrega_id', $entrega->id)->get()->first();
        if (!$comprueba) {
            $producto = $entrega->orden->producto;
            $total = (float)$producto->precio * (float)$entrega->orden->cantidad;

            $nuevo_pago = Pago::create([
                'entrega_id' => $entrega->id,
                'metodo_pago' => $request->metodo_pago,
                'fecha_pago' => date('Y-m-d'),
                'hora_pago' => date('H:i'),
                'fecha_hora_pago' => date('Y-m-d H:i'),
                'total_pago' => $total,
                'fecha_registro' => date('Y-m-d')
            ]);

            $cliente = $entrega->cliente;
            if ($cliente->email != '' && $cliente->email != null) {
                $data = [
                    'producto' => $producto->nombre,
                    'cantidad' => $entrega->orden->cantidad,
                    'precio' => $producto->precio,
                    'metodo' => $nuevo_pago->metodo_pago,
                    'fecha_hora' => date('d/m/Y H:i', strtotime($nuevo_pago->fecha_hora_pago)),
                    'total' => $total,
                ];
                $razon_social = RazonSocial::first();

                Mail::send('mail.info_entrega', $data, function ($msj) use ($razon_social, $cliente) {
                    $email_razon_social = \mb_strtolower($razon_social->correo);
                    if ($email_razon_social != '' && $email_razon_social != null) {
                        $msj->from($email_razon_social, $razon_social->nombre);
                    }
                    $msj->subject('Información Entrega Pedido');
                    $correo_cliente = \mb_strtolower($cliente->email);
                    $msj->to($correo_cliente, $cliente->nombre . ' ' . $cliente->paterno . ' ' . $cliente->materno);
                });
            }

            $entrega->estado = 'ENTREGADO';
            $entrega->orden->estado = 'ENTREGADO';
            $entrega->save();
            $entrega->orden->save();
            return redirect()->back()->with('bien', 'REGISTRO REALIZADO CON ÉXITO');
        }
        
        return redirect()->route('entregas.pago_entrega', $entrega->id)->with('error', 'YA SE REGISTRO EL PAGO DE ESTA ENTREGA');
    }

    public function g_info_ingresos(Request $request)
    {
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;
        $empresa = $request->empresa;

        $empresas = Empresa::all();
        if ($empresa != 'todos') {
            $empresas = Empresa::where('id', $empresa)->get();
        }
        $data = [];
        $total = 0;
        foreach ($empresas as $e) {
            $total_pago = Pago::join('entregas', 'entregas.id', '=', 'pagos.entrega_id')
                ->join('ordens', 'ordens.id', '=', 'entregas.orden_id')
                ->where('ordens.empresa_id', $e->id)
                ->whereBetween('pagos.fecha_pago', [$fecha_ini, $fecha_fin])->sum('pagos.total_pago');
            $total_pago = number_format($total_pago, 2, '.', '');
            $total = (float)$total + (float)$total_pago;
            $data[] = [$e->nombre, (float)$total_pago];
        }
        return response()->JSON([
            'sw' => true,
            'data' => $data,
            'total' => 'TOTAL: ' . $total
        ]);
    }
}
