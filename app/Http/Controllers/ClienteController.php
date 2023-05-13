<?php

namespace app\Http\Controllers;

use app\Cliente;
use app\Empresa;
use Illuminate\Http\Request;
use app\Http\Controllers\UserController;
use app\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public $validacion = [
        "nombre" => "required",
        "paterno" => "required",
        "ci" => "required|numeric|digits_between:1,10",
        "ci_exp" => "required",
        "dir" => "required",
        "email" => "required|email|unique:clientes,email",
        "fono" => "required|numeric|digits_between:1,10",
        "cel" => "required|numeric|digits_between:1,10",
    ];
    public $mensajes = [];


    public function index(Request $request)
    {
        $texto = '';
        if ($request->ajax()) {
            $texto = $request->texto;
        }
        $clientes = Cliente::select('clientes.*')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', 'CLIENTE')
            ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.paterno)'), 'LIKE', "%$texto%")
            ->orderBy('clientes.nombre', 'asc')
            ->get();
        if (Auth::user()->tipo == 'EMPRESA') {
            $clientes = Cliente::select('clientes.*')
                ->join('users', 'users.id', '=', 'clientes.user_id')
                ->where('users.estado', 1)
                ->where('users.tipo', 'CLIENTE')
                ->where('clientes.empresa_id', Auth::user()->datosUsuario->empresa_id)
                ->where(DB::raw('CONCAT(clientes.nombre, clientes.paterno, clientes.paterno)'), 'LIKE', "%$texto%")
                ->orderBy('clientes.nombre', 'asc')
                ->get();
        }

        if ($request->ajax()) {
            $html = view('clientes.parcial.lista', compact('clientes'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $empresas = Empresa::all();
        $array_empresas[''] = 'Seleccione...';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }
        return view('clientes.create', compact('array_empresas'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion);

        $request['fecha_registro'] = date('Y-m-d');
        $request['tipo'] = 'CLIENTE';
        $cliente = new Cliente(array_map('mb_strtoupper', $request->all()));
        $nombre_cliente = UserController::nombreUsuario($request->nombre, $request->paterno, $request->materno);

        $numero_cliente = [
            'ADMINISTRADOR' => 1001,
            'EMPRESA' => 2001,
            'DISTRIBUIDOR' => 3001,
            'CLIENTE' => 4001,
        ];

        $nuevo_usuario = new User();
        $nuevo_usuario->name = $request->email;
        $nuevo_usuario->password = Hash::make($request->ci);
        $nuevo_usuario->tipo = $request->tipo;
        $nuevo_usuario->foto = 'user_default.png';
        $nuevo_usuario->nro_usuario = 0;
        $nuevo_usuario->estado = 1;
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $cliente->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $nuevo_usuario->foto = $nom_foto;
        }
        $nuevo_usuario->save();
        $nuevo_usuario->cliente()->save($cliente);
        return redirect()->route('clientes.index')->with('bien', 'cliente registrado con éxito');
    }

    public function edit(Cliente $cliente)
    {
        $empresas = Empresa::all();
        $array_empresas[''] = 'Seleccione...';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }
        return view('clientes.edit', compact('cliente', 'array_empresas'));
    }

    public function update(Cliente $cliente, Request $request)
    {
        $cliente->update(array_map('mb_strtoupper', $request->except('foto')));
        if ($request->hasFile('foto')) {
            // antiguo
            $antiguo = $cliente->user->foto;
            if ($antiguo != 'user_default.png') {
                \File::delete(public_path() . '/imgs/users/' . $antiguo);
            }
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $cliente->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $cliente->user->foto = $nom_foto;
        }
        $cliente->user->save();
        return redirect()->route('clientes.index')->with('bien', 'cliente modificado con éxito');
    }

    public function show(Cliente $cliente)
    {
        return 'mostrar cliente';
    }

    public function destroy(User $user)
    {
        $user->estado = 0;
        $user->save();
        return redirect()->route('clientes.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function registrar_cliente(Request $request)
    {
        $request->validate($this->validacion);

        $request['fecha_registro'] = date('Y-m-d');
        $request['tipo'] = 'CLIENTE';
        $cliente = new Cliente(array_map('mb_strtoupper', $request->all()));

        $nuevo_usuario = new User();
        $nuevo_usuario->name = $request->email;
        $nuevo_usuario->password = Hash::make($request->ci);
        $nuevo_usuario->tipo = $request->tipo;
        $nuevo_usuario->foto = 'user_default.png';
        $nuevo_usuario->nro_usuario = 0;
        $nuevo_usuario->estado = 1;
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $cliente->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $nuevo_usuario->foto = $nom_foto;
        }
        $nuevo_usuario->save();
        $nuevo_usuario->cliente()->save($cliente);

        if (Auth::attempt(["name" => $nuevo_usuario->name, "password" => $cliente->ci])) {
            return redirect()->route('home')->with('bien', 'Registro éxitoso');
        }
        return redirect()->back()->with('error', 'Algo salió mal por favor intente mas tarde');
    }
}
