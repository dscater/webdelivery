@extends('layouts.acceder')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')

<div class="login-box" style="margin-top:0px!important;">
    <div class="login-logo">
        <a href=""><b>{{rae\RazonSocial::first()->nombre}}</b></a>
        {{-- <img src="{{asset('imgs/'.rae\RazonSocial::first()->logo)}}" alt="Logo"> --}}
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <h4 class="login-box-msg">Registro Cliente</h4>
            <form action="{{ route('registrar_cliente') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" autofocus placeholder="Nombre" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="apellido" value="{{old('apellido')}}" class="form-control" placeholder="Apellido" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="email" name="correo" value="{{old('correo')}}" class="form-control" placeholder="Correo Electrónico">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="cel" value="{{old('cel')}}" class="form-control" placeholder="Celular" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @if ($errors->has('password'))
                <span class="invalid-feedback" style="color:red;display:block" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                <!-- /.col -->
                <div class="col-12 mb-2">
                    <button type="submit" class="btn btn-default btn-block bg-green btn-sm">Registrar</button>
                </div>
                <div class="col-12 mb-2">
                    <a href="{{route('acceder')}}" class="btn btn-block btn-outline-warning btn-sm">Acceder</a>
                </div>
                <div class="col-12">
                    <a href="{{route('inicio')}}" class="btn btn-block btn-outline-primary btn-sm">Inicio</a>
                </div>
                <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection
