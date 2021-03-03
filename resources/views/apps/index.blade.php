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

    <h2>App Store</h2>

    <table id="apps" class="table table-dark">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio $</th>
                <th>Logo</th>
                <th>Creada</th>
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
                <td>{{$app->created_at->formatLocalized('%d/%m/%Y')}}</td>
                <td>
                    <div class="btn-group-sm" role="group" aria-label="Basic example">
                        <a href="{{ route('apps.show', $app) }}" class="btn btn-warning btn-group">Ver Detalles</a>
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
            "aaSorting":[[4,"desc"]],
            responsive: true
        });
    });
</script>

@endsection