@extends('master.master')

@section('content')
    <style>
        .subir {
            padding: 5px 10px;
            background: #016b0a;
            color: #fff;
            height: 38px;
            border: 0px solid #fff;
        }

        .subir:hover {
            color: #fff;
            background: #f7cb15;
        }
    
    </style>

    <body>
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary"
                                style="background: purple; color:white; border-radius: 15px">
                                <h4 class="card-title ">Producción Agricola de Traspatio</h4>
                                <p class="card-category">Registros </p>
                            </div>
                            @include('admin.modal.new_registro')

                            <div class="row">
                                <form method="POST" action="{{ route('importRegister') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Nuevo</a>

                                        <label for="file-upload" class="subir">
                                            <i class="fas fa-cloud-upload-alt"></i> Seleccionar Archivo
                                        </label>
                                        <input name="file" id="file-upload" onchange='cambiar()' type="file"
                                            style='display: none;' required />
                                        <button style=" height: 38px; padding: 2px;" class="btn btn-success" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>

                                <form name="formulario" action="{{ route('buscarx') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label for="exampleFormControlInput1" class="form-label">Municipio</label>

                                            <select name="s_municipio" class="form-select"
                                                aria-label="Default select example" id="s_municipio" onchange="cambiar()">
                                                @foreach ($municipios as $item)
                                                    <option @if ($s_municipio == $item->id) {{ 'selected' }} @endif
                                                        value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-sm-2">
                                            <label for="s_comunidad" class="form-label">
                                                comunidad
                                            </label>
                                            <select name="s_comunidad" id="s_comunidad" class="form-select"
                                                aria-label="Default select example">
                                            </select>
                                        </div>

                                        <div class="col-sm-2">
                                            <label for="s_categoria" class="form-label">
                                                Categoria
                                            </label>
                                            <select name="s_categoria" id="s_categoria" class="form-select"
                                                aria-label="Default select example" onchange="filtrar()">
                                                <option value="0">Todo</option>
                                                @foreach ($categorias as $item)
                                                    <option value="{{ $item->id }}">{{ $item->categoria }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-2">
                                            <label for="s_producto" class="form-label">
                                                Producto
                                            </label>
                                            <select name="s_producto" id="s_producto" class="form-select"
                                                aria-label="Default select example">
                                                <option value="0">Todo</option>
                                                @foreach ($productos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-3" style="margin-top: 32px">
                                            <button type="submit" href="" class="btn btn-primary">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-hover" style="font-size: 12px">
                                        <thead class="text-center" style="background: black;color: white">
                                            <th>Editar</th>
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
                                            <th>Eliminar</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($registros as $item)
                                            
                                                <tr>
                                                    <td style="padding: 0px;">
                                                        <a style=" height: 35px; padding: 2px; color:white" href=""
                                                            class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#modal-e-registro{{ $item->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                                fill="currentColor" class="bi bi-pencil-square"
                                                                viewBox="0 0 16 16">
                                                               
                                                                <path
                                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                        </a>
                                                        @include('admin.modal.edit_registro')
                                                    </td>
                                                    <td>{{ $item->comunidad->municipio->nombre }}</td>
                                                    <td>{{ $item->folio }}</td>
                                                    <td>{{ $item->comunidad->nombre }}</td>
                                                    <td>{{ $item->producto->categoria->categoria }}</td>
                                                    <td>{{ $item->producto->nombre }}</td>
                                                    <td>{{ $item->cantidad_produccion }}</td>

                                                    <td>{{ $item->um_produccion->unidad_medida }}</td>
                                                   
                                                    <td>{{ $item->cantidad_terreno }}</td>
                                                    <td>{{ $item->um_terreno->unidad_medida }} </td>

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
                                                    <td style="padding: 0px; text-align: center">
                                                        <a style=" height:35px; padding: 2px; color:white;"
                                                            class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modal-d-registro{{ $item->id }}">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                                fill="currentColor" class="bi bi-trash-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                            </svg>
                                                        </a>
                                                        @include('admin.modal.delete_registro')
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

    </body>

    </html>
@endsection

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



    var comunidades = @json($comunidades);

    function cambiar() {
        var s_municipio = @json($s_municipio);
        var c_comunidades = @json($c_comunidades);
        var select = document.getElementById('s_municipio');
        var seleccion = document.getElementById('s_comunidad');
        var contador = 0;

        for (index = 0; index < c_comunidades; index++) {
            if (comunidades[index]['municipio_id'] == select.value) {
                contador++;
            }
        }
        seleccion.length = contador + 1;
        seleccion.options[0].text = 'Todos';
        seleccion.options[0].value = '0';

        var indice = 0;
        for (index = 0; index < c_comunidades; index++) {
            if (comunidades[index]['municipio_id'] == select.value) {
                seleccion.options[indice + 1].text = comunidades[index]['nombre'];
                seleccion.options[indice + 1].value = comunidades[index]['id'];
                indice++;
            }
        }

    }

    function filtrar() {
        var productos = @json($productos);
        var select = document.getElementById('s_categoria');
        var select_producto = document.getElementById('s_producto');
        var contador = 0;
        for (let index = 0; index < productos.length; index++) {
            if (productos[index]['categoria_id'] == select.value) {
                contador++;
            }
        }

        if (select.value == 0) {
            select_producto.length = productos.length + 1;
            select_producto.options[0].text = 'Todos';
            select_producto.options[0].value = '0';
            var indice = 0;
            for (let index = 0; index < productos.length; index++) {
                select_producto.options[indice + 1].text = productos[index]['nombre'];
                select_producto.options[indice + 1].value = productos[index]['id'];
                indice++;
            }
        } else {
            select_producto.length = contador + 1;
            select_producto.options[0].text = 'Todos';
            select_producto.options[0].value = '0';
            var indice = 0;
            for (let index = 0; index < productos.length; index++) {
                if (productos[index]['categoria_id'] == select.value) {
                    select_producto.options[indice + 1].text = productos[index]['nombre'];
                    select_producto.options[indice + 1].value = productos[index]['id'];
                    indice++;
                }
            }
        }
        select_producto.value = 0;

    }

    function selectElement() {

        var s_comunidad = @json($s_comunidad);
        var s_municipio = @json($s_municipio);
        var s_categoria = @json($s_categoria);
        var s_producto = @json($s_producto);

        var seleccion = document.getElementById('s_comunidad');
        var select = document.getElementById('s_municipio');
        var select_categoria = document.getElementById('s_categoria');
        var select_producto = document.getElementById('s_producto');

        select.value = s_municipio;
        seleccion.value = s_comunidad;
        select_categoria.value = s_categoria;
        select_producto.value = s_producto;
        filtrar();
    }
    $(document).ready(function() {
        cambiar();
        selectElement();
    });
</script>
