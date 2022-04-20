@extends('master.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Inventario</h4>
                            <p class="card-category">Registros </p>
                            <a href="" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Nuevo</a>
                        </div>
                        @include('admin.modal.new_registro')

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-hover text-center"
                                    style="font-size: 12px">
                                    <thead class=" text-primary">
                                        <th>Municipio</th>
                                        <th>Folio</th>
                                        <th>Comunidad</th>
                                        <th>Categoria</th>
                                        <th>Producto</th>
                                        <th>Cantidad Producción</th>
                                        <th>UM Producción</th>
                                        <th>Cantidad Terreno</th>
                                        <th>UM Terreno</th>
                                        <th>Equivalencia kg</th>
                                        <th>Total Aproximado (kg)</th>
                                        <th>Total Aproximado (Toneladas)</th>
                                        <th>Comentarios</th>
                                        <th>Autoconsumo</th>
                                        <th>Desperdicio</th>
                                        <th>Venta</th>
                                        <th>Porcentaje Total</th>
                                        <th>Total Autoconsumo</th>
                                        <th>Total Desperdicio</th>
                                        <th>Total Venta</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros as $item)
                                            <tr>
                                                <td>{{ $item->comunidad->municipio->nombre }}</td>
                                                <td>{{ $item->folio }}</td>
                                                <td>{{ $item->comunidad->nombre }}</td>
                                                <td>{{ $item->categoria_id }}</td>
                                                <td>{{ $item->producto->nombre }}</td>
                                                <td>{{ $item->cantidad_produccion }}</td>
                                                <td>{{ $item->um_produccion_id }}</td>
                                                <td>{{ $item->cantidad_terreno }}</td>
                                                <td>{{ $item->um_terreno_id }}</td>
                                                <td>{{ $item->equivalencia_kg }} kg</td>
                                                <td>{{ $item->aprox_kg }} kg</td>
                                                <td>{{ $item->aprox_toneladas }}</td>
                                                <td>{{ $item->comentario }}</td>
                                                <td>{{ $item->autoconsumo }} %</td>
                                                <td>{{ $item->desperdicio }} %</td>
                                                <td>{{ $item->venta }} %</td>
                                                <td>{{ $item->porcentaje_total }} %</td>
                                                <td>{{ $item->total_autoconsumo }}</td>
                                                <td>{{ $item->total_desperdicio }}</td>
                                                <td class="text-primary">{{ $item->total_venta }}</td>

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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El Alumno se ha sido eliminado.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Estas Seguro de eliminar?',
                text: "El alumno se eliminara definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>


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

@push('js')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
