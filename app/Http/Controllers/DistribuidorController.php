<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Distribuidor;
use app\DatosUsuario;
use Illuminate\Support\Facades\Auth;

class DistribuidorController extends Controller
{
    public function index()
    {
        $distribuidors = Distribuidor::all();
        if (Auth::user()->tipo == 'DISTRIBUIDOR') {
            $distribuidors = Distribuidor::where('id', Auth::user()->datosUsuario->distribuidor_id)->get();
        }
        return view('distribuidors.index', compact('distribuidors'));
    }

    public function create()
    {
        return view('distribuidors.create');
    }

    public function store(Request $request)
    {
        Distribuidor::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('distribuidors.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Distribuidor $distribuidor)
    {
        return view('distribuidors.edit', compact('distribuidor'));
    }

    public function update(Distribuidor $distribuidor, Request $request)
    {
        $distribuidor->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('distribuidors.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Distribuidor $distribuidor)
    {
        return 'mostrar cargo';
    }

    public function destroy(Distribuidor $distribuidor)
    {
        $comprueba = DatosUsuario::where('distribuidor_id', $distribuidor->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('distribuidors.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $distribuidor->delete();
            return redirect()->route('distribuidors.index')->with('bien', 'Registro eliminado correctamdistribuidor');
        }
    }
}
