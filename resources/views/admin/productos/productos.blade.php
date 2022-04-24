@extends('master.master')

@section('content')
    <div class="content" >
        <div class="container-fluid" >
            <div class="row" >
                <div class="col-lg-8" style="margin: auto">

                    @if (session('eliminar') == 'ok')
                        <div class="alert alert-danger" role="alert">
                            Producto Eliminado!
                        </div>
                    @endif

                    @if (session('registro') == 'ok')
                        <div class="alert alert-success" role="alert">
                            Agregado Correctamente!
                        </div>
                    @endif

                    <div class="card" >
                        <div class="card-header card-header-primary" style="background: olive; color:white">
                            <h4 class="card-title ">Producto</h4>
                            <p class="card-category">Registros </p>
                            <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-producto">Nuevo</a>
                        </div>
                        @include('admin.modal.new_producto')
                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table id="table" class="table table-striped table-hover" >
                                    <thead class=" text-primary">
                                        <th>PRODUCTO</th>
                                        <th style="width: 100px">PRECIO POR KG</th>
                                        <th style="width: 100px">COSECHAS ESPERADAS</th>
                                        <th>CATEGORIA</th>
                                        <th>OPCIONES</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $item)
                                            <tr>
                                                <td class="text-primary">{{ $item->nombre }} </td>
                                                <td>{{ $item->precio_kg }} </td>
                                                <td>{{ $item->cosechas }} </td>
                                                <td>{{ $item->categoria->categoria }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">

                                                        <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#modal-e-producto{{ $item->id }}">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-pencil-square"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                        </a>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modal-d-producto{{ $item->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-trash-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                            </svg>
                                                        </button>

                                                    </div>

                                                    @include(
                                                        'admin.productos.modal_editar'
                                                    )
                                                    @include(
                                                        'admin.productos.modal_delete'
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

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
