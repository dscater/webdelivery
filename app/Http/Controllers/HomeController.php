<?php

namespace app\Http\Controllers;

use app\Cliente;
use app\DatosUsuario;
use app\Distribuidor;
use app\Empresa;
use app\Entrega;
use app\Orden;
use app\Producto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use app\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios = count(User::select('users.*')
            ->join('datos_usuarios', 'datos_usuarios.user_id', '=', 'users.id')
            ->where('users.estado', 1)
            ->get());

        $empresas = Empresa::all();

        $distribuidors =  DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', '=', 'DISTRIBUIDOR')
            ->orderBy('datos_usuarios.nombre', 'asc')
            ->get();

        $productos = Producto::where('estado', 1)->get();
        if (Auth::user()->tipo == 'EMPRESA') {
            $productos = Producto::where('estado', 1)
                ->where('empresa_id', Auth::user()->datosUsuario->empresa_id)->get();
        }

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
        }

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

        $clientes = Cliente::select('clientes.*')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', 'CLIENTE')
            ->get();

        return view('home', compact('usuarios', 'clientes', 'empresas', 'distribuidors', 'productos', 'ordens', 'entregas'));
    }
}
