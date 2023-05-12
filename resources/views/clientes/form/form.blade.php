<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre*</label>
            {{ Form::text('nombre', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Paterno*</label>
            {{ Form::text('paterno', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Materno</label>
            {{ Form::text('materno', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
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
            {{ Form::select(
    'ci_exp',
    [
        '' => 'Seleccione...',
        'LP' => 'LA PAZ',
        'CB' => 'COCHABAMBA',
        'SC' => 'SANTA CRUZ',
        'PT' => 'POTOSI',
        'OR' => 'ORURO',
        'CH' => 'CHUQUISACA',
        'TJ' => 'TARIJA',
        'BN' => 'BENI',
        'PD' => 'PANDO',
    ],
    null,
    ['class' => 'form-control', 'required'],
) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Dirección*</label>
            {{ Form::text('dir', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Correo*</label>
            {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Teléfono*</label>
            {{ Form::text('fono', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Celular*</label>
            {{ Form::text('cel', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
    </div>
</div>

@if(Auth::user()->tipo == 'EMPRESA')
<input type="hidden" name="empresa_id" value="{{Auth::user()->datosUsuario->empresa_id}}">
@else
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Empresa*</label>
            {{ Form::select('empresa_id', $array_empresas, null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
@endif
