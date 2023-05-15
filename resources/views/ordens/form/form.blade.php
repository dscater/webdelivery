<div class="row">
    @if (Auth::user()->tipo == 'DISTRIBUIDOR')
        <input type="hidden" name="distribuidor_id" id="distribuidor_id" value="{{ Auth::user()->id }}">
    @else
        <div class="col-md-4">
            <div class="form-group">
                <label>Distribuidor*</label>
                {{ Form::select('distribuidor_id', $array_distribuidors, null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
    @endif
    <div class="col-md-8">
        <div class="form-group">
            <label>Fecha Hora Entrega*</label>
            <div class="row">
                <div class="col-md-6">
                    {{ Form::date('fecha_entrega', isset($orden) && $orden->entrega ? $orden->fecha_entrega : date('Y-m-d'), ['class' => 'form-control', 'required']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::time('hora_entrega', isset($orden) && $orden->entrega ? $orden->hora_entrega : date('H:i'), ['class' => 'form-control', 'required']) }}
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="error-container">
            Tienes los sgtes. errores:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@include('ordens.parcial.orden')
