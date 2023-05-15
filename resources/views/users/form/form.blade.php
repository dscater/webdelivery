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
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Correo</label>
            {{ Form::email('email', null, ['class' => 'form-control']) }}
            @if ($errors->has('email'))
                <span class="invalid-feedback" style="color:red;display:block" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
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
    <div class="col-md-3">
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
    <div class="col-md-3">
        <div class="form-group">
            <label>Teléfono Referencia Directo*</label>
            {{ Form::text('fono_referencia', null, ['class' => 'form-control', 'required']) }}
            @if ($errors->has('fono_referencia'))
                <span class="invalid-feedback" style="color:red;display:block" role="alert">
                    <strong>{{ $errors->first('fono_referencia') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            @if (isset($usuario))
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            @else
                <label>Foto*</label>
                <input type="file" name="foto" class="form-control" required>
            @endif
            @if ($errors->has('foto'))
                <span class="invalid-feedback" style="color:red;display:block" role="alert">
                    <strong>{{ $errors->first('foto') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Tipo Usuario*</label>
            {{ Form::select(
                'tipo',
                [
                    '' => 'Seleccione...',
                    'ADMINISTRADOR' => 'ADMINISTRADOR',
                    'EMPRESA' => 'EMPRESA',
                    'DISTRIBUIDOR' => 'DISTRIBUIDOR',
                ],
                isset($usuario) ? $usuario->user->tipo : null,
                ['class' => 'form-control', 'required', 'id' => 'tipo'],
            ) }}
            @if ($errors->has('tipo'))
                <span class="invalid-feedback" style="color:red;display:block" role="alert">
                    <strong>{{ $errors->first('tipo') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @if (isset($usuario))
        @if ($usuario->user->tipo == 'EMPRESA' || $usuario->user->tipo == 'DISTRIBUIDOR')
            <div class="col-md-4">
                <div class="form-group" id="contenedor_empresas">
                    <label>Empresa</label>
                    @if ($usuario->user->tipo == 'EMPRESA')
                        {{ Form::select('empresa_id', $array_empresas, null, ['class' => 'form-control']) }}
                        @if ($errors->has('empresa_id'))
                            <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                <strong>{{ $errors->first('empresa_id') }}</strong>
                            </span>
                        @endif
                    @else
                        {{ Form::select('distribuidor_id', $array_distribuidors, null, ['class' => 'form-control']) }}
                        @if ($errors->has('distribuidor_id'))
                            <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                <strong>{{ $errors->first('distribuidor_id') }}</strong>
                            </span>
                        @endif
                    @endif

                </div>
            </div>
        @endif
    @else
        <div class="col-md-4">
            <div class="form-group" id="contenedor_empresas">
            </div>
        </div>
    @endif
</div>
