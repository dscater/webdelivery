<div class="modal fade" id="modal-reasigna_contrasenia">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <h4 class="modal-title text-white">REASIGNAR CONTRASEÑÁ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <form action="" method="POST" id="formReasignaContrasenia">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between bg-white">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn bg-orange text-white" id="btnReasignaContrasenia" style="color:white!important;">Aceptar</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
