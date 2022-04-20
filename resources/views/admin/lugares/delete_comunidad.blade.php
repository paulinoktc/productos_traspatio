<div class="modal fade" id="modal-d-comunidad{{ $itemc->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Municipio?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comunidad.destroy', $itemc->id) }} " class="formulario-eliminar" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <svg style="color: orange" xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                            fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <br>
                        El Municipio se va a eliminar!

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Eiminar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
