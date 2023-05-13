<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use app\DatosUsuario;
use app\Distribuidor;
use app\Empresa;
use Illuminate\Support\Facades\Hash;
use app\Http\Requests\UserStoreRequest;
use app\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->where('users.tipo', '!=', 'CLIENTE')
            ->orderBy('datos_usuarios.nombre', 'asc')
            ->get();

        if ($request->ajax()) {
            $texto = $request->texto;
            $usuarios = DatosUsuario::select('datos_usuarios.*')
                ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                ->where('users.estado', 1)
                ->where('users.tipo', '!=', 'CLIENTE')
                ->where(DB::raw('CONCAT(datos_usuarios.nombre, datos_usuarios.paterno, datos_usuarios.paterno)'), 'LIKE', "%$texto%")
                ->orderBy('datos_usuarios.nombre', 'asc')
                ->get();

            $html = view('users.parcial.lista', compact('usuarios'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }
        return view('users.index', compact('usuarios'));
    }

    public function create()
    {
        $empresas = Empresa::all();
        $array_empresas[''] = 'Niguno';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }
        return view('users.create', compact('array_empresas'));
    }

    public function store(UserStoreRequest $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $usuario = new DatosUsuario(array_map('mb_strtoupper', $request->all()));
        $nombre_usuario = UserController::nombreUsuario($request->nombre, $request->paterno, $request->materno);

        $numero_usuario = [
            'ADMINISTRADOR' => 1001,
            'EMPRESA' => 2001,
            'DISTRIBUIDOR' => 3001,
            'CLIENTE' => 4001,
        ];

        $ultimo_nro_user = User::where('tipo', $request->tipo)->where('nro_usuario', '!=', 0)->orderBy('nro_usuario', 'asc')->get()->last();
        $nro_name = $numero_usuario[$request->tipo];
        if ($ultimo_nro_user) {
            $nro_name = (int)$ultimo_nro_user->nro_usuario + 1;
        }

        $nombre_usuario = $nro_name . $nombre_usuario;

        $comprueba = User::where('name', $nombre_usuario)->get()->first();
        $cont = 1;
        while ($comprueba) {
            $nombre_usuario = $nombre_usuario . $cont;
            $comprueba = User::where('name', $nombre_usuario)->get()->first();
            $cont++;
        }

        $nuevo_usuario = new User();
        $nuevo_usuario->name = $nombre_usuario;
        $nuevo_usuario->password = Hash::make($request->ci);
        $nuevo_usuario->tipo = $request->tipo;
        $nuevo_usuario->foto = 'user_default.png';
        $nuevo_usuario->nro_usuario = $nro_name;
        $nuevo_usuario->estado = 1;
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $usuario->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $nuevo_usuario->foto = $nom_foto;
        }
        $nuevo_usuario->save();
        $nuevo_usuario->datosUsuario()->save($usuario);
        return redirect()->route('users.index')->with('bien', 'Usuario registrado con éxito');
    }

    public function edit(DatosUsuario $usuario)
    {
        $empresas = Empresa::all();
        $array_empresas[''] = 'Niguno';
        foreach ($empresas as $value) {
            $array_empresas[$value->id] = $value->nombre;
        }

        $distribuidors = Distribuidor::all();
        $array_distribuidors[''] = 'Niguno';
        foreach ($distribuidors as $value) {
            $array_distribuidors[$value->id] = $value->nombre;
        }
        return view('users.edit', compact('usuario', 'array_empresas', 'array_distribuidors'));
    }

    public function update(DatosUsuario $usuario, UserUpdateRequest $request)
    {
        $usuario->update(array_map('mb_strtoupper', $request->except('foto')));
        $usuario->user->tipo = $request->tipo;
        if ($request->hasFile('foto')) {
            // antiguo
            $antiguo = $usuario->user->foto;
            if ($antiguo != 'user_default.png') {
                \File::delete(public_path() . '/imgs/users/' . $antiguo);
            }
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $usuario->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $usuario->user->foto = $nom_foto;
        }
        $usuario->user->save();
        return redirect()->route('users.index')->with('bien', 'Usuario modificado con éxito');
    }

    public function show(DatosUsuario $usuario)
    {
        return 'mostrar usuario';
    }

    public function destroy(User $user)
    {
        $user->estado = 0;
        $user->save();
        return redirect()->route('users.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function reemplazar_password(User $usuario, Request $request)
    {
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        return response()->JSON([
            "sw" => true
        ]);
    }

    public static function nombreUsuario($nom, $apep, $apem)
    {
        //determinando el nombre de usuario inicial del 1er_nombre+apep+tipoUser
        $nombre_user = substr(mb_strtoupper($nom), 0, 1); //inicial 1er_nombre
        $nombre_user .= substr(mb_strtoupper($apep), 0, 1);
        if ($apem != '' && $apem != null) {
            $nombre_user .= substr(mb_strtoupper($apem), 0, 1);
        }

        return $nombre_user;
    }

    // VISTA CONFIGURACIÓN DE USUARIO
    public function config(User $user)
    {
        return view('users.config', compact('user'));
    }

    // NUEVA CONTRASEÑA POR USUARIOS
    public function cuenta_update(Request $request, User $user)
    {
        if ($request->oldPassword) {
            if (Hash::check($request->oldPassword, $user->password)) {
                if ($request->newPassword == $request->password_confirm) {
                    $user->password = Hash::make($request->newPassword);
                    $user->save();
                    return redirect()->route('users.config', $user->id)->with('bien', 'Contraseña actualizada con éxito');
                } else {
                    return redirect()->route('users.config', $user->id)->with('error', 'Error al confirmar la nueva contraseña');
                }
            } else {
                return redirect()->route('users.config', $user->id)->with('error', 'La contraseña (Antigua contraseña) no coincide con nuestros registros');
            }
        }
    }

    // NUEVA FOTO POR USUARIOS
    public function cuenta_update_foto(Request $request, User $user)
    {
        if ($request->ajax()) {
            if ($request->hasFile('foto')) {
                $archivo_img = $request->file('foto');
                $extension = '.' . $archivo_img->getClientOriginalExtension();
                $codigo = $user->name;
                $path = public_path() . '/imgs/users/' . $user->foto;
                if ($user->foto != 'user_default.png') {
                    \File::delete($path);
                }
                // SUBIENDO FOTO AL SERVIDOR
                if ($user->empleado) {
                    $name_foto = $codigo . $user->empleado->nombre . time() . $extension; //determinar el nombre de la imagen y su extesion
                } else {
                    $name_foto = $codigo . time() . $extension; //determinar el nombre de la imagen y su extesion
                }
                $name_foto = str_replace(' ', '_', $name_foto);
                $archivo_img->move(public_path() . '/imgs/users/', $name_foto); //mover el archivo a la carpeta de destino

                $user->foto = $name_foto;
                $user->save();
                session(['bien' => 'Foto actualizado con éxito']);
                return response()->JSON([
                    'msg' => 'actualizado'
                ]);
            }
        }
    }

    public function getTipo(Request $request)
    {
        $tipo = $request->tipo;
        $sw = false;
        $html = '';

        if ($tipo == 'EMPRESA') {
            $sw = true;
            $empresas = Empresa::all();
            $array_empresas[''] = 'Niguno';

            $html = '<label>Empresa*</label>
                <select name="empresa_id" class="form-control" required>
                    <option value="">Seleccione...</option>';
            foreach ($empresas as $value) {
                $html .= '<option value="' . $value->id . '">' . $value->nombre . '</option>';
            }
            $html .= '</select>';
        } elseif ($tipo == 'DISTRIBUIDOR') {
            $sw = true;
            $distribuidors = Distribuidor::all();
            $array_distribuidors[''] = 'Niguno';

            $html = '<label>Distribuidor*</label>
                <select name="distribuidor_id" class="form-control" required>
                    <option value="">Seleccione...</option>';
            foreach ($distribuidors as $value) {
                $html .= '<option value="' . $value->id . '">' . $value->nombre . '</option>';
            }
            $html .= '</select>';
        } else {
            $sw = false;
            $html = '';
        }

        return response()->JSON([
            'sw' => $sw,
            'html' => $html
        ]);
    }
}
