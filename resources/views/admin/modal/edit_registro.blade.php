<div class="modal fade" id="modal-e-registro{{ $item->id }}" tabindex="-1" role="dialog"
    aria-bs-labelledby="exampleModalLabel" aria-bs-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-e-registro">Editar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('registro.update',$item->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="folio">Folio</label>
                        <input name="folio" type="text" class="form-control" id="folio" placeholder="Escribe Folio"
                            required value="{{ $item->folio }}">
                    </div>

                    <div class="form-group">
                        <label for="comunidad">Selecciona Comunidad</label>
                        <select name="comunidad" class="form-select" id="comunidad">
                            @foreach ($comunidades as $items)
                                <option @if ($item->comunidad_id == $items->id) {{ 'selected' }}@endif value="{{ $items->id }}">
                                    {{ $items->municipio->nombre . ' : ' . $items->nombre }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="categoria">Selecciona Categoria</label>
                        <select name="categoria" class="form-select" id="categoria">
                            @foreach ($categorias as $items)
                                <option @if ($item->categoria_id == $items->id) {{ 'selected' }}@endif value="{{ $items->id }}">
                                    {{ $items->categoria }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Selecciona Producto</label>
                        <select name="producto" class="form-select" id="categoria">
                            @foreach ($productos as $items)
                                <option @if ($item->producto_id == $items->id) {{ 'selected' }}@endif value="{{ $items->id }}">
                                    {{ $items->nombre }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="cantida_produccion">Cantidad Producción</label>
                        <input class="form-control" name="cantidad_produccion" id="cantida_produccion" type="number"
                            placeholder="Escribe Cantidad Producción" required="true" aria-required="true" min="0"
                            step="any" value="{{ $item->cantidad_produccion }}" />
                    </div>


                    <div class="form-group">
                        <label for="um_produccion">Selecciona Unidad de Medida Producción</label>
                        <select name="um_produccion" class="form-select" id="um_produccion">
                            @foreach ($um_produccion as $items)
                                <option @if ($item->um_produccion_id == $items->id) {{ 'selected' }}@endif value="{{ $items->id }}">
                                    {{ $items->unidad_medida }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="cantida_terreno">Cantidad Terreno</label>
                        <input class="form-control" name="cantidad_terreno" id="cantida_terreno" type="number"
                            placeholder="Escribe Cantidad de Terreno" required="true" aria-required="true" min="0"
                            step="any" value="{{$item->cantidad_terreno}}" />
                    </div>


                    <div class="form-group">
                        <label for="um_terreno">Selecciona Unidad de Medida Terreno</label>
                        <select name="um_terreno" class="form-select" id="um_terreno">
                            @foreach ($um_produccion as $items)
                                <option value="{{ $items->id }}">
                                    {{ $items->unidad_medida }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="equivalencia">Equivalencia (kg)</label>
                        <input class="form-control" name="equivalencia" id="equivalencia" type="number"
                            placeholder="Equivalencia kg" required="true" aria-required="true" min="0"
                            step="any" value="{{$item->equivalencia_kg}}" />
                    </div>


                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="comentario">Comentario</label>
                        <input name="comentario" type="text" class="form-control" id="comentario"
                            placeholder="Escribe Comentario" value="{{$item->comentario}}" required>
                    </div>

                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="autoconsumo">Autoconsumo</label>
                        <input class="form-control" name="autoconsumo" id="autoconsumo" type="number"
                            placeholder="Cantidad Autoconsumo" required="true" aria-required="true" min="0"
                            step="any" value="{{$item->autoconsumo}}" />
                    </div>


                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="desperdicio">Desperdicio</label>
                        <input class="form-control" name="desperdicio" id="desperdicio" type="number"
                            placeholder="Escribe Cantidad de desperdicio" required="true" aria-required="true" min="0"
                            step="any" value="{{$item->desperdicio}}" />
                    </div>


                    <div class="form-group">
                        <label style="color: rgb(43, 137, 226);" for="ventas">Venta</label>
                        <input class="form-control" name="ventas" id="ventas" type="number"
                            placeholder="Escribe Cantidad de Terreno" required="true" aria-required="true" min="0"
                            step="any" value="{{$item->venta}}" />
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
<style>
    label {
        color: rgb(43, 137, 226);
    }

</style>
