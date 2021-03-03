@extends('layouts.app')

@section('content')

<div class="container my-4">
        <div class="btn-group-sm" role="group" aria-label="Basic example">
            <form action="{{ route('apps.buy', $app) }}" method="POST" class="d-inline">
                @csrf
                @if ($activateBuyButton)
                    <input type="button" class="btn btn-primary btn-sm btn-group" value="Comprar"
                        onclick =   @if (auth()->guest()) "location.href = '../../login'"
                                    @else "if(confirm('¿Comprar App?')) {this.form.submit();} "
                                    @endif
                    />
                @endif
                
            </form>
            <a href="{{ route('apps.index') }}" class="btn btn-secondary btn-sm" role="button">Volver</a>
        </div>

    <h1><br>#{{ $app->id }} - {{ $app->name }}</h1>

        <!-- DATOS -->
        <div class="card">
            <div class="card-header">Detalles</div>
            <div class="card-body">
                    <table>
                    <tr><td><b>Logo:</b></td><td> {{ $app->logo }}</td></tr>
                    <tr><td><b>Precio:</b></td><td> ${{ $app->price }}</td></tr>
                    <tr><td><b>Categoría:</b></td><td> {{ $app->category }}</td></tr>
                    <tr><td><b>Descripción:</b></td><td> {{ $app->description }} </td></tr>
                    </table>

                    <br><i><b>Creado:</b> {{ $app->created_at->formatLocalized('%d/%m/%Y a las %H:%M hs') }}</i>
                    <br><i><b>Actualizado:</b> {{ $app->updated_at->formatLocalized('%d/%m/%Y a las %H:%M hs') }}</i>
                    @if ( $app->deleted_at != null )
                        <br><i style="color: red"><b>Eliminado:</b>  {{ $app->deleted_at->formatLocalized('%d/%m/%Y a las %H:%M hs')}}</i>
                    @endif
            </div>
        </div>
</div>

@endsection