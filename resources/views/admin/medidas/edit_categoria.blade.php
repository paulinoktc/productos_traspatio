<div class="modal fade" id="modal-e-categoria{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('categoria.update', $item->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="um_categoria">Unidad Medida Categoria</label>
                        <input name="um_categoria" type="text" class="form-control" id="um_terreno"
                            aria-describedby="emailHelp" value="{{ $item->categoria }}" placeholder="Escribe Unidad Medida Categoria">
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
