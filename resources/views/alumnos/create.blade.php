@extends('layouts/template')

@section('contenido')
<main>
    <div class="container-fluid py-4">
        <div class="container py-4">
            @if ($errors->any()) <!-- Todo esto se  mete en un if -->
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error) <!--  Este foreach se muestra un lista de errores cuando el formulario no es contestado
                    con las validaciones que se le asignaron -->
    
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <form action="{{url('alumnos/')}}" method="post" class="bg-light border rounded p-4">
                @csrf
              
                <h2 class="text-center mb-4" >Registro de Alumno</h2>  <div class="form-group row">
                  <label for="matricula" class="col-sm-2 col-form-label text-muted" style="color: #333;">Matricula</label>  <div class="col-sm-5">
                    <input type="text" class="form-control border-dark" name="matricula" id="matricula" value="{{old('matricula')}}" required>
                  </div>
                </div>
              
                <div class="form-group row">
                  <label for="nombre" class="col-sm-2 col-form-label text-muted" style="color: #333;">Nombre</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control border-dark" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                  </div>
                </div>
              
                <div class="form-group row">
                  <label for="fecha" class="col-sm-2 col-form-label text-muted" style="color: #333;">Fecha De Nacimiento</label>
                  <div class="col-sm-5">
                    <input type="date" class="form-control border-dark" name="fecha" id="fecha" value="{{old('fecha')}}" required>
                  </div>
                </div>
              
                <div class="form-group row">
                  <label for="telefono" class="col-sm-2 col-form-label text-muted" style="color: #333;">Telefono</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control border-dark" name="telefono" id="telefono" value="{{old('telefono')}}" required>
                  </div>
                </div>
              
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label text-muted" style="color: #333;">Email</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control border-dark" name="email" id="email" value="{{old('email')}}">
                  </div>
                </div>
              
                <div class="form-group row mt-4">
                  <div class="col-sm-10 offset-sm-2">
                    <a href="{{url('home')}}" class="btn btn-outline-secondary float-left">Regresar</a>
                    <button type="submit" class="btn btn-primary float-right">Guardar</button>
                  </div>
                </div>
              
              </form>
</main>
@endsection


          