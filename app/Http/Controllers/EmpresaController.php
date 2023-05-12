<?php

namespace app\Http\Controllers;

use app\Cliente;
use Illuminate\Http\Request;
use app\Empresa;
use app\DatosUsuario;
use app\Producto;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        if (Auth::user()->tipo == 'EMPRESA') {
            $empresas = Empresa::where('id', Auth::user()->datosUsuario->empresa_id)->get();
        }
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        Empresa::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('empresas.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Empresa $empresa, Request $request)
    {
        $empresa->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('empresas.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Empresa $empresa)
    {
        return 'mostrar cargo';
    }

    public function destroy(Empresa $empresa)
    {
        $comprueba = DatosUsuario::where('empresa_id', $empresa->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('empresas.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $empresa->delete();
            return redirect()->route('empresas.index')->with('bien', 'Registro eliminado correctamempresa');
        }
    }

    public function productos(Request $request)
    {
        $empresa_id = $request->empresa_id;
        $productos = Producto::where('empresa_id', $empresa_id)
            ->where('estado', 1)->get();
        $options_productos = '<option value="">Seleccione...</option>';
        foreach ($productos as $value) {
            $options_productos .= '<option value="' . $value->id . '">' . $value->nombre . '</option>';
        }

        $options_clientes = '<option value="">Seleccione...</option>';
        $clientes = Cliente::select('clientes.*')
            ->join('users', 'users.id', '=', 'clientes.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', 'CLIENTE')
            ->where('clientes.empresa_id', $empresa_id)
            ->orderBy('clientes.nombre', 'asc')
            ->get();

        foreach ($clientes as $value) {
            $options_clientes .= '<option value="' . $value->id . '">' . $value->nombre . ' ' . $value->paterno . ' ' . $value->materno . '</option>';
        }

        return response()->JSON([
            'productos' => $options_productos,
            'clientes' => $options_clientes
        ]);
    }
}
