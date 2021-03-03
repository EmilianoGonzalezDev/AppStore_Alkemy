@extends('layouts.app')

@section('content')

<div class="container my-4">
    @if ( session('returnedMessage') ) {{-- OK message --}}
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('returnedMessage') }}
    </div>
    @endif

    @if (Session::has('deleted'))
    <div class="alert alert-warning alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        App eliminada, si desea deshacer haga <a href="{{ route('apps.restore', [Session::get('deleted')]) }}">Click aquí</a>
    </div>
    @endif

    <h2>Mis Apps Creadas</h2>
    <div class="my-4"><a href="{{ route('apps.create') }}" class="btn btn-primary btn-sm">Crear Nueva</a></div>
    <table id="apps" class="table table-dark">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio $</th>
                <th>Logo</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apps as $app)
            <tr>
                <td>{{$app->name}}</td>
                <td>{{$app->category}}</td>
                <td>{{$app->price}}</td>
                <td>{{$app->logo}}</td>
                <td>{{$app->description}}</td>
                <td>
                    <div class="btn-group-sm" role="group" aria-label="Basic example">
                        <a href="{{ route('apps.edit', $app) }}" class="btn btn-info btn-group">Editar</a>
                        <form action="{{ route('apps.destroy', $app) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <input type=button class="btn btn-secondary btn-sm btn-group" value="Eliminar" onclick="if(confirm('Se eliminará la app ¿Continuar?')){this.form.submit();}" />
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#apps').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            responsive: true
        });
    });
</script>

@endsection