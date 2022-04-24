<div class="modal fade" id="modal-e-producto{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('productos.update', $item->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input name="producto" type="text" class="form-control" id="producto"
                            value="{{ $item->nombre }}">
                    </div>

                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="precio_kg">Precio por (kg)</label>
                        <input class="form-control" name="precio_kg" id="precio_kg" type="number"
                            placeholder="Escribe Precio por kg" required="true" aria-required="true" min="0"
                            value="{{ $item->precio_kg }}" step="any" />
                    </div>

                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="cosechas">Cosechas Esperadas</label>
                        <input class="form-control" name="cosechas" id="cosechas" type="number"
                            placeholder="Escribe Cosechas Anuales" required="true" aria-required="true" min="0"
                            value="{{ $item->cosechas }}" />
                    </div>

                    <div class="form-group">
                        <label for="categoria">Selecciona Comunidad</label>
                        <select name="categoria" class="form-select" id="categoria">
                            @foreach ($categorias as $items)
                                <option @if ($item->categoria_id == $items->id) {{ 'selected' }} @endif
                                    value="{{ $items->id }}">
                                    {{ $items->categoria}}</option>
                            @endforeach
                        </select>
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
