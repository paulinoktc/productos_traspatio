@extends('master.master')
@section('content')
    <form name="seccion" action="">
        <select name="municipio" id="" onchange="cambiar()">
            @foreach ($municipios as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
            @endforeach
        </select>

        <select class="seleccion" name="comun">
        </select>

    </form>


    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>

    <script type="text/javascript">
        var seleccionado = document.seccion.municipio.value;

        var dato = $.ajax({
            url: '{!! route('test.show', 2) !!}',
            type: 'GET',
            success: function(mostrar_elementos) {
                $('.seleccion').html(mostrar_elementos)
            }
        });

        var comunidades = @json($comunidades);

        function cambiar() {
            var seleccionado = document.seccion.municipio.value;
            $.ajax({
                url: seleccionado,
                type: 'GET',
                /*
                data: {
                    id: seleccionado,
                    somefield: "Some field value",
                    _token: '{{ csrf_token() }}'
                },
                */
                success: function(mostrar_elementos) {
                    $('.seleccion').html(mostrar_elementos)
                }
            });
            for (var index = 0; index < comunidades.length; index++) {
                console.log(comunidades[index]["nombre"])
            }
        }
    </script>
@endsection
