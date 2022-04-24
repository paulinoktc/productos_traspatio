<div class="modal fade" id="modal-producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input name="producto" type="text" class="form-control" id="producto"
                            placeholder="Escribe nombre Producto">
                    </div>

                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="precio_kg">Precio por (kg)</label>
                        <table>
                            <tr>
                                <td>$</td>
                                <td style="width: 400px">
                                    <input class="form-control" name="precio_kg" id="precio_kg" type="number"
                                        placeholder="Escrine Precio" required="true" aria-required="true" min="0"
                                        step="any" />
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="cosechas">Cosechas Esperadas</label>
                        <input class="form-control" name="cosechas" id="cosechas" type="number"
                            placeholder="Escribe Cosechas Anuales" required="true" aria-required="true" min="0" />
                    </div>

                    <div class="form-group">
                        <label for="categoria">Selecciona Comunidad</label>
                        <select name="categoria" class="form-select" id="categoria">
                            @foreach ($categorias as $items)
                                <option value="{{ $items->id }}">
                                    {{ $items->categoria }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
