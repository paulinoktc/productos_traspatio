<div class="modal fade" id="modal-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close">

                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('categoria.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="categoria">Neva Categoria</label>
                        <input name="categoria" type="text" class="form-control" id="categoria"
                            placeholder="Ingresa Categoria">
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
