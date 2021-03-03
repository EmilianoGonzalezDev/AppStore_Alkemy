@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar App</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('apps.update', $app->id) }}">
                    @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Precio $</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="any" min="0" max="999999" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $app->price }}" required autocomplete="off" >

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">Logotipo</label>

                            <div class="col-md-6">
                                <input id="logo" type="text" maxlength="60" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ $app->logo }}" autocomplete="off">

                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-6">
                                <input id="description" type="text" maxlength="100" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $app->description }}" autocomplete="off">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="enviar_formulario">
                                    Aceptar
                                </button>
                                <a href="{{ route('apps.index') }}" class="btn btn-secondary" role="button">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection