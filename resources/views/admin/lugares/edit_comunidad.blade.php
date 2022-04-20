<div class="modal fade" id="modal-e-comunidad{{ $itemc->id }}" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Comunidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('comunidad.update', $itemc->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecciona Municipio</label>
                        <select name="municipio_s" class="form-select" id="exampleFormControlSelect1">
                            @foreach ($municipios as $itm)
                                <option @if ($itemc->municipio_id == $itm->id) {{ 'selected' }} @endif
                                    value="{{ $itm->id }}"> {{ $itm->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comunidad">Comunidad</label>
                        <input name="comunidad" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $itemc->nombre }}" placeholder="Escribe Comunidad">
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
