<div class="modal fade" id="modal-comunidad-c" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Comunidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form method="POST" action="{{ route('comunidad.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="comunidad">Comunidad</label>
                        <input name="comunidad" type="text" class="form-control" id="comunidad"
                            aria-describedby="emailHelp" placeholder="Escrine nombre Comunidad">
                    </div>

                    <div class="form-group">
                        <label for="municipio_s">Selecciona Municipio</label>
                        <select name="municipio_s" class="form-select" id="municipio_s">
                            @foreach ($municipios as $items)
                                <option value="{{ $items->id }}"> {{ $items->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
