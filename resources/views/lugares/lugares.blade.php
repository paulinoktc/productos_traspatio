@extends('master.master')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="card m-2" style="width: 30rem">
                <div class="card-title p-2">
                    <h5 class="card-title">Lista de Municipios</h5>

                </div>
                <div class="card-body">
                    @if (session('municipio') == 'ok')
                        <div class="alert alert-success" role="alert">
                            Municipio Creado Correctamente!
                        </div>
                    @endif

                    @if (session('municipio') == 'edit')
                        <div class="alert alert-success" role="alert">
                            Editado Correctamente!
                        </div>
                    @endif


                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-municipio-c">Nuevo
                    </button>
                    <div class="table-responsive">
                        <table  class="table table-striped table-hover">
                            <thead class=" text-primary">
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Opciones
                                </th>

                            </thead>
                            <tbody>
                                @foreach ($municipios as $item)
                                    <tr>
                                        <td>{{ $item->nombre }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <button class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modal-e-municipio{{ $item->id }}">Editar</button>

                                                <button class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modal-d-municipio{{ $item->id }}">Eliminar</button>
                                            </div>
                                            @include('admin.lugares.edit-municipio')
                                            @include('admin.lugares.delete_municipio')
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="card m-2" style="width:45rem;">
                <div class="card-title p-2">
                    <h5 class="card-title">Lista de Comunidades</h5>

                </div>
                <div class="card-body">
                    @if (session('comunidad') == 'ok')
                        <div class="alert alert-success" role="alert">
                            Creado Correctamente!
                        </div>
                    @endif
                    @if (session('comunidad') == 'edit')
                        <div class="alert alert-success" role="alert">
                            Editado Correctamente!
                        </div>
                    @endif
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-comunidad-c">Nuevo
                    </button>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-hover">
                            <thead class=" text-primary">
                                <th>Municipio</th>
                                <th>Comunidad</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($comunidades as $itemc)
                                    <tr>
                                        
                                        <td>
                                            {{ $itemc->municipio->nombre }}
                                        </td>
                                        <td class="text-primary">
                                            {{ $itemc->nombre }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modal-e-comunidad{{ $itemc->id }}">Editar</a>

                                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modal-d-comunidad{{ $itemc->id }}">Eliminar</button>
                                            </div>
                                            @include('admin.lugares.edit_comunidad')
                                            @include('admin.lugares.delete_comunidad')
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('admin.modal.new_municipio')
    @include('admin.modal.new_comunidad')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if (session('mensaje') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Registro Eliminado.',
                'success'
            )
        </script>
    @endif

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                //para cambiar el lenguaje a español
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing": "Procesando...",
                }
            });
        });
    </script>
@endsection
