<div class="modal fade" id="um_m_produccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Unidad Medida Producción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('um_produccion.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="um_produccion">Unidad de Medida Produccion</label>
                        <input name="um_produccion" type="text" class="form-control" id="um_produccion"
                            placeholder="Unidad de medida">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
