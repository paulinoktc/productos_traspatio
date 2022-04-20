<div class="modal fade" id="um_m_terreno" tabindex="-1" role="dialog" aria-bs-labelledby="exampleModalLabel"
    aria-bs-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Unidad Medida Terreno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            
            <div class="modal-body">
                <form method="POST" action="{{ route('um_terreno.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="um_terreno">Unidad de Medida Terreno</label>
                        <input name="um_terreno" type="text" class="form-control" id="um_terreno"
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
