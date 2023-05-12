<div class="modal fade" id="modal-devolucion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <h4 class="modal-title text-white">CONFIRMAR REGISTRO DEVOLUCIÓN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="POST" id="formRegistraDevolucion">
                            @csrf
                            <p id="mensaje_devolucion"></p>
                            <div class="form-group">
                                <label>Observaciones</label>
                                <textarea name="observaciones" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between bg-white">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn bg-orange text-white" id="btnRegistraDevolucion" style="color:white!important;">Confirmar devolución</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
