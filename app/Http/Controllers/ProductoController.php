<?php

namespace app\Http\Controllers;

use app\Producto;
use app\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $texto = '';
        $productos = Producto::where('estado', 1)->get();
        if (Auth::user()->tipo == 'EMPRESA') {
            $productos = Producto::where('estado', 1)
                ->where('empresa_id', Auth::user()->datosUsuario->empresa_id)->get();
        }

        if ($request->ajax()) {
            $texto = $request->texto;
            $productos = Producto::select('productos.*')
                ->join('empresas', 'empresas.id', '=', 'productos.empresa_id')
                ->where('productos.estado', 1)
                ->where(DB::raw('CONCAT(productos.nombre, empresas.nombre)'), 'LIKE', "%$texto%")
                ->get();
            if (Auth::user()->tipo == 'EMPRESA') {
                $productos = Producto::select('productos.*')
                    ->join('empresas', 'empresas.id', '=', 'productos.empresa_id')
                    ->where('productos.estado', 1)
                    ->where('productos.empresa_id', Auth::user()->datosUsuario->empresa_id)
                    ->where(DB::raw('CONCAT(clientes.nombre, empresas.nombre)'), 'LIKE', "%$texto%")
                    ->get();
            }

            $html = view('productos.parcial.lista', compact('productos'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $empresas = Empresa::all();
        $array_empresas[''] = 'Seleccione...';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }
        return view('productos.create', compact('array_empresas'));
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado'] = 1;
        Producto::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('productos.index')->with('bien', 'Registro correcto');
    }

    public function edit(Producto $producto)
    {
        $empresas = Empresa::all();
        $array_empresas[''] = 'Seleccione...';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }
        return view('productos.edit', compact('producto', 'array_empresas'));
    }

    public function update(Producto $producto, Request $request)
    {
        $producto->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('productos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Producto $producto)
    {
        return 'mostrar producto';
    }

    public function destroy(Producto $producto)
    {
        $producto->estado = 0;
        $producto->save();
        return redirect()->route('productos.index')->with('bien', 'Registro eliminado correctamente');
    }
}
