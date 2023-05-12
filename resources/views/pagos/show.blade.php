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
                        <div class="card-header">
                            {{-- <h3 class="card-title"></h3> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h4>Detalles de Pago</h4>
                            <p><strong>Producto: </strong>{!! $pago->entrega->orden->producto->nombre !!}</p>
                            <p><strong>Cantidad: </strong>{!! $pago->entrega->orden->cantidad !!}</p>
                            <p><strong>Precio Unitario: </strong>{!! $pago->entrega->orden->producto->precio !!}</p>
                            <p><strong>Método de pago: </strong>{!! $pago->metodo_pago !!}</p>
                            <p><strong>Fecha y Hora: </strong>{!! date('d/m/Y H:i',strtotime($pago->fecha_hora_pago)) !!}</p>
                            <p><strong>Total: </strong>{!! $pago->total_pago !!}</p>
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
