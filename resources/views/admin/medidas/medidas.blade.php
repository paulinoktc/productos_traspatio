@extends('master.master')

@section('content')
    <div class="content">
        <div class="card-header card-header-primary text-center" style="background: purple; color: white;">
            <h4 class="card-title ">UNIDADES DE MEDIDA</h4>

        </div>
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        @if (session('terreno') == 'ok')
                            <div class="alert alert-success" role="alert">
                                Terreno Creado Correctamente!
                            </div>
                        @endif

                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Terreno</h4>
                            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#um_m_terreno">
                                Nuevo
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-striped table-hover">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            UNIDAD DE MEDIDA
                                        </th>
                                        <th>
                                            EDITAR
                                        </th>

                                    </thead>
                                    <tbody>
                                        @foreach ($ums_terreno as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->id }}
                                                </td>
                                                <td>
                                                    {{ $item->unidad_medida }}

                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-bs-label="Basic example">
                                                        <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#modal-e-terreno{{ $item->id }}">Editar</a>
                                                        <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modal-d-terreno{{ $item->id }}">Eliminar</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('admin.medidas.edit_terreno')
                                            @include('admin.medidas.delete_terreno')
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        @if (session('municipio') == 'ok')
                            <div class="alert alert-success" role="alert">
                                Municipio Creado Correctamente!
                            </div>
                        @endif

                        <div class="card-header card-header-warning">
                            <h4 class="card-title ">Categorias</h4>
                            <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-categoria">
                                Nuevo
                            </a>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-striped table-hover">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            UNIDAD DE MEDIDA
                                        </th>
                                        <th>
                                            EDITAR
                                        </th>

                                    </thead>
                                    <tbody>
                                        @foreach ($categorias as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->id }}
                                                </td>
                                                <td>
                                                    {{ $item->categoria }}

                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#modal-e-categoria{{ $item->id }}">Editar</a>

                                                        <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modal-d-categoria{{ $item->id }}">Eliminar</button>
                                                    </div>

                                                    @include(
                                                        'admin.medidas.edit_categoria'
                                                    )
                                                    @include(
                                                        'admin.medidas.delete_categoria'
                                                    )
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
        </div>

        <div class="row">


            <div class="col-lg-6 col-md-12">
                <div class="card">
                    @if (session('comunidad') == 'ok')
                        <div class="alert alert-success" role="alert">
                            Creado Correctamente!
                        </div>
                    @endif

                    <div class="card-header card-header-info">
                        <h4 class="card-title ">Producción</h4>
                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#um_m_produccion">
                            Nuevo
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-hover">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        UNIDAD DE MEDIDA
                                    </th>
                                    <th>
                                        Editar
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($ums_produccion as $item)
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                {{ $item->unidad_medida }}
                                            </td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#modal-e-produccion{{ $item->id }}">Editar</a>
                                                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modal-d-produccion{{ $item->id }}">Eliminar</button>
                                                </div>

                                                @include(
                                                    'admin.medidas.edit_produccion'
                                                )
                                                @include(
                                                    'admin.medidas.delete_produccion'
                                                )

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
    </div>

    @include('admin.modal.new_um_terreno')
    @include('admin.modal.um_produccion')
    @include('admin.modal.new_categoria')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Se ha eliminado.',
                'success'
            )
        </script>
    @endif

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
