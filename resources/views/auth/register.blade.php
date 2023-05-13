@extends('layouts.login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        .login-box{
            width: 60%;
        }
        @media (max-width:800px){
            .login-box{
                width: 98%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="login-box" style="margin-top:0px!important;">
        <div class="login-logo">
            <a href=""><b>{{ app\RazonSocial::first()->nombre }}</b></a>
            {{-- <img src="{{asset('imgs/'.app\RazonSocial::first()->logo)}}" alt="Logo"> --}}
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h4 class="login-box-msg">Registro Cliente</h4>
                <form action="{{ route('registrar_cliente') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre*</label>
                                {{ Form::text('nombre', null, ['class' => 'form-control', 'required']) }}
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Paterno*</label>
                                {{ Form::text('paterno', null, ['class' => 'form-control', 'required']) }}
                                @if ($errors->has('paterno'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('paterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Materno</label>
                                {{ Form::text('materno', null, ['class' => 'form-control']) }}
                                @if ($errors->has('materno'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('materno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>C.I.*</label>
                                {{ Form::number('ci', null, ['class' => 'form-control', 'required']) }}
                                @if ($errors->has('ci'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('ci') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Expedido*</label>
                                {{ Form::select('ci_exp', ['' => 'Seleccione...', 'LP' => 'LA PAZ', 'CB' => 'COCHABAMBA', 'SC' => 'SANTA CRUZ', 'PT' => 'POTOSI', 'OR' => 'ORURO', 'CH' => 'CHUQUISACA', 'TJ' => 'TARIJA', 'BN' => 'BENI', 'PD' => 'PANDO'], null, ['class' => 'form-control', 'required']) }}
                                @if ($errors->has('ci_exp'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('ci_exp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dirección*</label>
                                {{ Form::text('dir', null, ['class' => 'form-control', 'required']) }}
                                @if ($errors->has('dir'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('dir') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo*</label>
                                {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Teléfono*</label>
                                {{ Form::text('fono', null, ['class' => 'form-control', 'required']) }}
                                @if ($errors->has('fono'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('fono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Celular*</label>
                                {{ Form::text('cel', null, ['class' => 'form-control', 'required']) }}
                                @if ($errors->has('cel'))
                                    <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                        <strong>{{ $errors->first('cel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-default btn-block bg-green btn-sm">Enviar registro</button>
                        </div>
                        <div class="col-12 mb-2">
                            <a href="{{ route('login') }}" class="btn btn-block btn-default btn-sm">Iniciar sesión</a>
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
