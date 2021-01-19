@extends('layouts.app')

@section('content')
@if (!Auth::guest())
    <div class="container bg-white border my-3 p-4 col-md-6" style="border-radius: 10px;">
        <h2 class="text-justify">Administrador</h2>
        <div class="card-header" style="margin-top: 10px;">
            No puede acceder al formulario de solicitud porque es administrador. Para acceder cierre la sesión de administrador actual.
        </div>
    </div>
@else
    <div class="container bg-white border my-3 p-4 col-md-6" style="border-radius: 10px;">
        <h2 class="text-justify">Solicitar Documento de Identificación Personal</h2>
        <div class="card-header" style="margin-top: 10px;">
            Por favor llene todos los campos correctamente. Al finalizar pulse el botón Enviar y recibirá un correo electrónico con una contraseña, esta le servira para iniciar sesión en la aplicación para verificar el estado de su DPI. Será notificado cuando esté listo.
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form
            action="{{ route('public.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="row align-items-center g-3">
            <div class="col-md-6 form-group">
                <label for="cui" class="form-label">CUI</label>
                <input type="text" id="cui" name="cui" class="form-control" value="{{ old('cui') }}" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="identification_card" class="form-label">Cédula (Opcional)</label>
                <input type="text" id="identification_card" name="identification_card" class="form-control" value="{{ old('identification_card') }}">
            </div>
            <div class="col-md-6 form-group">
                <label for="name" class="form-label">Nombres</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="last_name" class="form-label">Apellidos</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
            </div>
            <div class="col-md-4 form-group">
                <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ old('birthdate') }}" required>
            </div>
            <div class="col-md-8 form-group">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="department" class="form-label">Departamento</label>
                <input type="text" id="department" name="department" class="form-control" value="{{ old('department') }}" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="township" class="form-label">Municipio</label>
                <input type="text" id="township" name="township" class="form-control" value="{{ old('township') }}" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="col-md-8 form-group">
                <label for="file" class="form-label">Fotografía Tamaño Cédula</label>
                <input  type="file" id="file" name="image" class="form-control" value="{{ old('image') }}" required>
            </div>
            <div class="col-md-2 form-group">
                @csrf
                <input type="submit" value="Enviar" class="btn btn-sm btn-primary" style="margin-left: 50px; margin-top:30px;" onclick="return confirm('¿Está seguro que los datos son correctos?')">
            </div>
        </form>
    </div>
@endif
@endsection