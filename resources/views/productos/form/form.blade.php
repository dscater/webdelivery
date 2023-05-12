<div class="row">
    @if(Auth::user()->tipo == 'EMPRESA')
    <div class="col-md-4">
        <div class="form-group">
            <label>Empresa*</label>
            {{ Form::select('empresa_id', [Auth::user()->datosUsuario->empresa_id=>Auth::user()->datosUsuario->empresa->nombre], null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    @else
    <div class="col-md-4">
        <div class="form-group">
            <label>Empresa*</label>
            {{ Form::select('empresa_id', $array_empresas, null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    @endif
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre producto*</label>
            {{ Form::text('nombre', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Descripción*</label>
            {{ Form::text('descripcion', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Precio*</label>
            {{ Form::number('precio', null, ['class' => 'form-control', 'required', 'step' => '0.01','min'=>'0.01']) }}
        </div>
    </div>
</div>
