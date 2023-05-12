<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Ente;
use app\Presupuesto;

class EnteController extends Controller
{
    public function index()
    {
        $entes = Ente::all();
        return view('entes.index', compact('entes'));
    }

    public function create()
    {
        return view('entes.create');
    }

    public function store(Request $request)
    {
        Ente::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('entes.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Ente $ente)
    {
        return view('entes.edit', compact('ente'));
    }

    public function update(Ente $ente, Request $request)
    {
        $ente->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('entes.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Ente $ente)
    {
        return 'mostrar cargo';
    }

    public function destroy(Request $request)
    {
        $ente = Ente::findOrFail($request->id);
        $comprueba = Presupuesto::where('ente_id', $ente->id)->get();
        if (count($comprueba) > 0) {
            if ($request->ajax()) {
                return response()->JSON([
                    'sw' => false,
                    'msj' => 'No se pudo eliminar el registro porque esta siendo utilizado'
                ]);
            }
            return redirect()->route('entes.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $id = $ente->id;
            $ente->delete();
            if ($request->ajax()) {
                return response()->JSON([
                    'sw' => true,
                    'id' => $id,
                    'msj' => 'Registro eliminado correctamente',
                ]);
            }
            return redirect()->route('entes.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
