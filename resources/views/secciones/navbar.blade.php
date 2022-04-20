<nav class="navbar navbar-light navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">

        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        </button>

        <a class="navbar-brand" href="{{ route('registro.index') }}">Inicio</a>
        <a class="navbar-brand" href="{{ route('municipio.index') }} ">Municipios</a>
        <a class="navbar-brand" href="{{ route('medidas.index') }}">Medidas</a>
        <a class="navbar-brand" href="{{ route('productos.index') }}">Productos</a>
        <a class="navbar-brand" href="{{ route('registro.show', 1) }}">Informe</a>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        </div>
        <div>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                </ul>
            </div>
        </div>
    </div>
</nav>
