
<div class="modal fade" id="modal-e-municipio{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Municipio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('municipio.update', $item->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Municipio</label>
                        <input name="municipio" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $item->nombre }}" placeholder="Escribe Municipio">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
