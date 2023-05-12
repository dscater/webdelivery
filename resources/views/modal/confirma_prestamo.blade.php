<div class="modal fade" id="modal-confirma_prestamo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <h4 class="modal-title text-white">CONFIRMAR SOLICITUD PRÉSTAMO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <form action="{{route('solicituds.store')}}" method="POST" id="formConfirmaPrestamo">
                    @csrf
                    <input type="hidden" name="libro_id" id="libro_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="informacionLibroPrestamo"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Desea hacer alguna observación o comentario</label>
                                <textarea name="observacion" id="observacion" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="mensaje_confirma_prestamo"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between bg-white">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn bg-orange text-white" id="btnConfirmaPrestamos" style="color:white!important;">Confirmar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
