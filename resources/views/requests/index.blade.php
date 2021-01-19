@extends('layouts.app')

@section('content')
<div class="container bg-white border my-3 p-4 col-md-7" style="border-radius: 10px;">
    <h2 class="text-justify">Solicitudes</h2>
    <div class="card-header" style="margin-top: 10px;">
        Puede actualizar el estado del documento de identificación personal.
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
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th colspan="5">
                    <h1 style="text-align: center;">Listado de Solicitudes</h1>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>DPI</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Estado Actual</th>
                <th>Actualizar</th>
                
            </tr>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->person->cui }}</td>
                    <td>{{ $request->person->name }}</td>
                    <td>{{ $request->person->last_name }}</td>
                    <!--@switch($request->status)
                    @case('process')
                        <td>En Proceso</td>
                        @break
                    @case('deliver')
                        <td>Listo Para Entregar</td>
                        @break
                    @default
                        <td>Solicitado</td>
                    @endswitch-->
                   <td>
                        <form
                            action="{{ route('admin.update', $request) }}"
                            method="POST">
                            <input type="hidden" name="id" value="{{ $request->id }}" required>
                            <select class="form-select form-select-sm" name="status">    
                                <option value="requested" @if($request->status == 'requested') selected @endif>Solicitado</option>
                                <option value="process" @if($request->status == 'process') selected @endif>En Proceso</option>
                                <option value="deliver" @if($request->status == 'deliver') selected @endif>Listo Para Entregar</option>
                            </select>
                    </td>
                    <td>
                        @csrf
                        @method('PUT')
                        <button type="submit" name="btnGrabar" class="btn btn-sm btn-primary" onclick="return confirm('¿Desea actualizar el estado?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                              </svg>
                        </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection