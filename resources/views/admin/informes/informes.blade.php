@extends('master.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary"
                            style="background: purple; color:white; border-radius: 15px">
                            <h4 class="card-title ">Proyección Económica Anualizada</h4>
                            <p class="card-category">Registros </p>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive" style="width: 80%; margin: auto">

                                <div>
                                    <form name="formulario" action="{{ route('filtrarcomunidades') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label for="select-municipio" class="form-label">Municipio</label>
                                                <select name="municipio" class="form-select"
                                                    aria-label="Default select example" onchange="cambiar()"
                                                    id="select-municipio">
                                                    @foreach ($municipios as $item)
                                                        <option @if ($municipio == $item->id) {{ 'selected' }} @endif
                                                            value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label">Comunidad</label>
                                                <select id="comunidad" name="comunidad" class="form-select"
                                                    aria-label="Default select example">
                                                    @foreach ($comunidades as $item)
                                                        <option @if ($comunidad == $item->id) {{ 'selected' }} @endif
                                                            value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="col-sm-3" style="margin-top: 33px">
                                                <button type="submit" href="" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <table id="table" class="table table-striped text-center table-hover"
                                    style="font-size: 12px;width: ">
                                    <thead class="text-center" style="background: black;color: white">
                                        <th style="width: 50px">PRODUCTO</th>
                                        <th style="width: 50px">PRECIO</th>
                                        <th style="width:35px">COSECHAS</th>
                                        <th style="width:50px">T</th>
                                        <th>VALOR PRODUCCION</th>
                                        <th>AUTOCONSUMO</th>
                                        <th>DESPERDICIO</th>
                                        <th>VENTA</th>
                                        <th>SUMA</th>

                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            @if ($item['valor_produccion'] > 0)
                                                <tr>
                                                    <td>{{ $item['producto']->nombre }}</td>
                                                    <td>{{ $item['producto']->precio_kg }}</td>
                                                    <td>{{ $item['producto']->cosechas }}</td>
                                                    <td>{{ round($item['t_toneladas'], 4) }}</td>
                                                    <td>{{ round($item['valor_produccion'], 4) }}</td>
                                                    <td>{{ round($item['autoconsumo'], 4) }}</td>
                                                    <td>{{ round($item['desperdicio'], 4) }}</td>
                                                    <td>{{ round($item['venta'], 4) }}</td>
                                                    <td>{{ round($item['venta'] + $item['desperdicio'] + $item['autoconsumo'], 4) }}
                                                    </td>
                                                </tr>
                                            @endif
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
    <script>
        function cambiar() {
            var select = document.getElementById('select-municipio');
            var comunidades = @json($comunidades);
            //contando la longitud de las comunidades que pertenecen al muincipio seleccionado
            var cantidad = 0;
            for (var index = 0; index < comunidades.length; index++) {
                if (comunidades[index]["municipio_id"] == select.value) {
                    cantidad++;
                }
            }
            cantidad += 1;
            //estableciendo nueva logitud
            document.formulario.comunidad.length = cantidad;
            //asignando value y text a cada option
            var contador = -1;
            for (var index = 0; index < comunidades.length; index++) {
                if (comunidades[index]["municipio_id"] == select.value) {
                    contador++;
                    document.formulario.comunidad.options[contador].value = comunidades[index]['id'];
                    document.formulario.comunidad.options[contador].text = comunidades[index]['nombre'];
                }
            }
            document.formulario.comunidad.options[contador+1].value = 0;
            document.formulario.comunidad.options[contador+1].text = 'Todo';
        }

        function selectComunidad() {
            var comunidad = @json($comunidad);
            var select_comunidad = document.getElementById("comunidad");
            select_comunidad.value = comunidad;
            console.log(comunidad);
        }

        cambiar();
        selectComunidad();
    </script>
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
</script>
