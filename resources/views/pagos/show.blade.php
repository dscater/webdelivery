@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pagos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pagos.index') }}">Pagos</a></li>
                        <li class="breadcrumb-item active">Ver Información Pago</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h4>Detalles de Pago</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Método de pago: </strong>{!! $pago->metodo_pago !!}</p>
                                    <p><strong>Fecha y hora del pago: </strong>{!! date('d/m/Y H:i', strtotime($pago->fecha_hora_pago)) !!}</p>
                                    <p><strong>Total: </strong>{!! $pago->total_pago !!}</p>
                                </div>
                            </div>
                            @php
                                $orden = $pago->entrega->orden;
                                $entrega = $pago->entrega;
                            @endphp
                            @include('ordens.parcial.orden')
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>


@section('scripts')
@endsection
@endsection
