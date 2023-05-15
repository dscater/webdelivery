<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'Proceso realizado';
});


Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/registrar_cliente', 'ClienteController@registrar_cliente')->name("registrar_cliente");

Route::get('/home', 'HomeController@index')->name('home');

Route::get('entregas/pago_entrega/{entrega}', 'EntregaController@pago_entrega')->name('entregas.pago_entrega');

Route::middleware(['auth'])->group(function () {

    // USUARIOS
    Route::get('users', 'UserController@index')->name('users.index');

    Route::get('users/create', 'UserController@create')->name('users.create');

    Route::post('users/store', 'UserController@store')->name('users.store');

    Route::get('users/edit/{usuario}', 'UserController@edit')->name('users.edit');

    Route::post('users/update/reemplazar_password/{usuario}', 'UserController@reemplazar_password')->name('users.reemplazar_password');

    Route::put('users/update/{usuario}', 'UserController@update')->name('users.update');

    Route::delete('users/destroy/{user}', 'UserController@destroy')->name('users.destroy');

    Route::get('users/getTipo', 'UserController@getTipo')->name('users.getTipo');

    // Configuración de cuenta
    Route::GET('users/configurar/cuenta/{user}', 'UserController@config')->name('users.config');

    // contraseña
    Route::PUT('users/configurar/cuenta/update/{user}', 'UserController@cuenta_update')->name('users.config_update');

    // foto de perfil
    Route::POST('users/configurar/cuenta/update/foto/{user}', 'UserController@cuenta_update_foto')->name('users.config_update_foto');

    // PRODUCTOS
    Route::get('productos/lista_empresas', 'ProductoController@lista_empresas')->name('productos.lista_empresas');

    Route::get('productos', 'ProductoController@index')->name('productos.index');

    Route::get('productos/create', 'ProductoController@create')->name('productos.create');

    Route::post('productos/store', 'ProductoController@store')->name('productos.store');

    Route::get('productos/edit/{producto}', 'ProductoController@edit')->name('productos.edit');

    Route::put('productos/update/{producto}', 'ProductoController@update')->name('productos.update');

    Route::delete('productos/destroy/{producto}', 'ProductoController@destroy')->name('productos.destroy');

    // ORDENES
    Route::get('ordens', 'OrdenController@index')->name('ordens.index');

    Route::get('ordens/create', 'OrdenController@create')->name('ordens.create');

    Route::post('ordens/store', 'OrdenController@store')->name('ordens.store');

    Route::get('ordens/edit/{orden}', 'OrdenController@edit')->name('ordens.edit');

    Route::put('ordens/update/{orden}', 'OrdenController@update')->name('ordens.update');

    Route::delete('ordens/destroy/{orden}', 'OrdenController@destroy')->name('ordens.destroy');

    Route::get('ordens/cliente_ordens', 'OrdenController@cliente_ordens')->name('ordens.cliente_ordens');

    // EMPRESAS
    Route::get('empresas', 'EmpresaController@index')->name('empresas.index');

    Route::get('empresas/create', 'EmpresaController@create')->name('empresas.create');

    Route::post('empresas/store', 'EmpresaController@store')->name('empresas.store');

    Route::get('empresas/edit/{empresa}', 'EmpresaController@edit')->name('empresas.edit');

    Route::put('empresas/update/{empresa}', 'EmpresaController@update')->name('empresas.update');

    Route::delete('empresas/destroy/{empresa}', 'EmpresaController@destroy')->name('empresas.destroy');

    Route::get('empresas/productos', 'EmpresaController@productos')->name('empresas.productos');

    // DISTRIBUIDORS
    Route::get('distribuidors', 'DistribuidorController@index')->name('distribuidors.index');

    Route::get('distribuidors/create', 'DistribuidorController@create')->name('distribuidors.create');

    Route::post('distribuidors/store', 'DistribuidorController@store')->name('distribuidors.store');

    Route::get('distribuidors/edit/{distribuidor}', 'DistribuidorController@edit')->name('distribuidors.edit');

    Route::put('distribuidors/update/{distribuidor}', 'DistribuidorController@update')->name('distribuidors.update');

    Route::delete('distribuidors/destroy/{distribuidor}', 'DistribuidorController@destroy')->name('distribuidors.destroy');

    // ENTREGAS
    Route::get('entregas', 'EntregaController@index')->name('entregas.index');

    Route::get('entregas/create', 'EntregaController@create')->name('entregas.create');

    Route::post('entregas/store', 'EntregaController@store')->name('entregas.store');

    Route::get('entregas/edit/{entrega}', 'EntregaController@edit')->name('entregas.edit');

    Route::put('entregas/update/{entrega}', 'EntregaController@update')->name('entregas.update');

    Route::delete('entregas/destroy/{entrega}', 'EntregaController@destroy')->name('entregas.destroy');

    Route::get('entregas/qr_pdf/{entrega}', 'EntregaController@qr_pdf')->name('entregas.qr_pdf');

    Route::get('entregas/g_info_entregas', 'EntregaController@g_info_entregas')->name('entregas.g_info_entregas');

    // CLIENTES
    Route::get('clientes', 'ClienteController@index')->name('clientes.index');

    Route::get('clientes/create', 'ClienteController@create')->name('clientes.create');

    Route::post('clientes/store', 'ClienteController@store')->name('clientes.store');

    Route::get('clientes/edit/{cliente}', 'ClienteController@edit')->name('clientes.edit');

    Route::put('clientes/update/{cliente}', 'ClienteController@update')->name('clientes.update');

    Route::delete('clientes/destroy/{user}', 'ClienteController@destroy')->name('clientes.destroy');

    // PAGOS
    Route::get('pagos', 'PagoController@index')->name('pagos.index');

    Route::post('pagos/store/{entrega}', 'PagoController@store')->name('pagos.store');

    Route::get('pagos/g_info_ingresos', 'PagoController@g_info_ingresos')->name('pagos.g_info_ingresos');

    Route::get('pagos/show/{pago}', 'PagoController@show')->name('pagos.show');

    // RAZON SOCIAL
    Route::get('razon_social/index', 'RazonSocialController@index')->name('razon_social.index');

    Route::get('razon_social/edit/{razon_social}', 'RazonSocialController@edit')->name('razon_social.edit');

    Route::put('razon_social/update/{razon_social}', 'RazonSocialController@update')->name('razon_social.update');

    // REPORTES
    Route::get('reportes', 'ReporteController@index')->name('reportes.index');

    Route::get('reportes/usuarios', 'ReporteController@usuarios')->name('reportes.usuarios');

    Route::get('reportes/ordens', 'ReporteController@ordens')->name('reportes.ordens');

    Route::get('reportes/entregas', 'ReporteController@entregas')->name('reportes.entregas');

    Route::get('reportes/pagos', 'ReporteController@pagos')->name('reportes.pagos');
});
