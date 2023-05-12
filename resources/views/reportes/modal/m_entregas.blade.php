<div class="modal fade" id="m_entregas">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Lista de Entrega de Pedidos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.entregas', 'method' => 'get', 'target' => '_blank', 'id' => 'formentregas']) !!}
                <div class="row">
                    @if(Auth::user()->tipo == 'EMPRESA')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Empresa*</label>
                            {{Form::select('empresa',[Auth::user()->datosUsuario->empresa_id=>Auth::user()->datosUsuario->empresa->nombre],null,['class'=>'form-control','required'])}}
                        </div>
                    </div>
                    @else
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Empresa*</label>
                            {{ Form::select('empresa', $array_empresas, null, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    @endif

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cliente*</label>
                            {{ Form::select('cliente', $array_clientes, null, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha inicio*</label>
                            <input type="date" name="fecha_ini" id="fecha_ini" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha fin*</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnentregas">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
