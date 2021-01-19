@extends('layouts.app')

@section('content')
<div class="container bg-white border my-3 p-4 col-md-5" style="border-radius: 10px;">
    <h2 class="text-justify">Iniciar Sesión como Administrador</h2>
    <div class="card-header" style="margin-top: 10px;">
        Inicie sesión con las credenciales de administrador.
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong> 
            </div>
        @endif
    </div>
    <form
        method="POST"
        action="{{ route('login') }}"
        class="row align-items-center g-3">
        @csrf
        <div class="col-md-6 form-group">
            <label for="email" class="form-label text-md-right">Correo Electrónico</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 form-group">
            <label for="password" class="form-label text-md-right">Contraseña</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-12 offset-md-9">
            <button type="submit" class="btn btn-primary">
                Iniciar Sesión
            </button>
        </div>
        
    </form>     
</div>
@endsection