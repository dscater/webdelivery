@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ordenes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ordens.index') }}">Ordenes</a></li>
                        <li class="breadcrumb-item active">Nuevo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nuevo registro</h3>
                        </div>
                        <!-- /.card-header -->
                        {!! Form::open(['route' => 'ordens.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="card-body">
                            @include('ordens.form.form')
                            <button class="btn btn-info"><i class="fa fa-save"></i> GUARDAR</button>
                        </div>
                        {!! Form::close() !!}
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <input type="hidden" value="{{route('empresas.productos')}}" id="urlProductos">
@endsection
@section('scripts')
<script src="{{asset('js/ordens/create.js')}}"></script>
@endsection
