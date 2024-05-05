@extends('layouts/template')

@section('contenido')
<main>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title fw-bold text-uppercase fs-5">Editar Alumno</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <ul class="m-0">
                                @foreach($errors->all() as $error)
                                <li class="fw-normal">{{$error}}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{url('alumnos/'.$alumno->id)}}" method="post">
                            @method("PUT")
                            @csrf
                            <div class="mb-3 row">
                                <label for="matricula" class="col-sm-3 col-form-label fw-bold">Matricula</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="matricula" id="matricula" value="{{$alumno->matricula}}">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nombre" class="col-sm-3 col-form-label fw-bold">Nombre Completo</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{$alumno->nombre}}" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="fecha" class="col-sm-3 col-form-label fw-bold">Fecha De Nacimiento</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="fecha" id="fecha" value="{{$alumno->fecha_nacimiento}}" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="telefono" class="col-sm-3 col-form-label fw-bold">Telefono</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{$alumno->telefono}}" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label fw-bold">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" id="email" value="{{$alumno->email}}">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-9 offset-sm-3">
                                    <a href="{{url('alumnos')}}" class="btn btn-secondary me-2">Regresar</a>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


