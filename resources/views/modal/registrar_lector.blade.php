<div class="modal fade" id="modal-registrar_lector">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h4 class="modal-title text-white">REGISTRO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gray">
                <form action="{{ route('registrar_lector') }}" method="POST" id="formUpdateControl">
                    @csrf
                    <input type="hidden" id="l_id" name="l_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" autofocus placeholder="Nombre(s)" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="apellidos" value="{{old('apellidos')}}" class="form-control" autofocus placeholder="Apelldos" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" name="ci" value="{{old('ci')}}" class="form-control" autofocus placeholder="C.I." required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-address-card"></span>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('ci'))
                                <span class="invalid-feedback" style="color:rgb(161, 14, 14);display:block" role="alert">
                                    <strong>{{ $errors->first('ci') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="ci_exp" id="ci_exp" class="form-control" required>
                                        <option value="">Expedido</option>
                                        <option value="LP">LA PAZ</option>
                                        <option value="CB">COCHABAMBA</option>
                                        <option value="SC">SANTA CRUZ</option>
                                        <option value="PT">POTOSI</option>
                                        <option value="OR">ORURO</option>
                                        <option value="CH">CHUQUISACA</option>
                                        <option value="TJ">TARIJA</option>
                                        <option value="PD">PANDO</option>
                                        <option value="BN">BENI</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-address-card"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" name="correo" value="{{old('correo')}}" class="form-control" autofocus placeholder="Correo electronico" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" name="cel" value="{{old('cel')}}" class="form-control" autofocus placeholder="Teléfono/Celular" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <input type="text" name="dir" value="{{old('dir')}}" class="form-control" autofocus placeholder="Dirección" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-address-book"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" style="color:rgb(161, 14, 14);display:block" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between bg-gray">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn bg-black" id="btnRegistraUsuario" style="color:white!important;">Registrar</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
