<div class="modal fade" id="modal-acceder_lector">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-navy">
                <h4 class="modal-title text-white">ACCEDER</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-gray">
                <form action="{{ route('lector_login') }}" method="POST" id="formLoginLector">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="name" value="{{ session('name_error') }}" class="form-control" autofocus placeholder="Correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if(session('name_error'))
                        <span class="invalid-feedback" style="color:rgb(161, 14, 14);display:block;" role="alert">
                            <strong>El usuario o contraseña son incorrectos</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="mensaje_acceder_lector"></div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between bg-gray">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn bg-orange text-white" id="btnRegistraUsuario" style="color:white!important;">Acceder</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
