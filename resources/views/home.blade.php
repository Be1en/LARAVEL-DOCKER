@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div class="card-body">
                    <h1 class="text-center p-3">Agenda Personal</h1>
                    <div class="m-3">
                        @if (session("exito"))
                        <div class="alert alert-success">{{session("exito")}}</div>
                        @endif
                        @if (session("error"))
                        <div class="alert alert-danger">{{session("error")}}</div>
                        @endif

                        <script>
                        var res = function() {
                            var not = confirm("¿Estas seguro de eliminar a este contacto?");
                            return not;
                        }
                        </script>

                    </div>

                    <!-- Modal para agregar -->
                    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Contacto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" action="{{ route('registrar') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nombre-input" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre-input"
                                                placeholder="Ingrese su nombre" name="txtNombre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tel-input" class="form-label">Telefono</label>
                                            <input type="number" class="form-control" id="tel-input"
                                                placeholder="Ingrese su telefono" name="txtTel" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email-input" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email-input"
                                                placeholder="Ingrese su email" name="txtEmail" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="direccion-input" class="form-label">Direccion</label>
                                            <input type="text" class="form-control" id="direccion-input"
                                                name="txtDireccion" placeholder="Ingrese su direccion" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 table-responsive">
                        <button class="btn btn-primary ml-5 mb-2" data-bs-toggle="modal"
                            data-bs-target="#modalRegistrar">Añadir
                            Contacto</button>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Direccion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datos as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->nombre}}</td>
                                    <td>{{$item->telefono}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->direccion}}</td>
                                    <td>
                                        <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEditar{{$item->id}}"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{route("eliminar",$item->id)}}" onclick="return res()"
                                            class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>

                                    </td>

                                    <!-- Modal para editar -->
                                    <div class="modal fade" id="modalEditar{{$item->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Datos
                                                        de
                                                        Contacto</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" action="{{ route('editar') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="txtId" value="{{ $item->id }}">

                                                        <div class="mb-3">
                                                            <label for="nombre-input" class="form-label">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre-input"
                                                                name="txtNombre" placeholder="Ingrese su nombre"
                                                                value="{{$item->nombre}}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tel-input" class="form-label">Telefono</label>
                                                            <input type="number" class="form-control" id="tel-input"
                                                                name="txtTel" placeholder="Ingrese su telefono"
                                                                value="{{$item->telefono}}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email-input" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email-input"
                                                                name="txtEmail" placeholder="Ingrese su email"
                                                                value="{{$item->email}}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="direccion-input"
                                                                class="form-label">Direccion</label>
                                                            <input type="text" class="form-control" id="direccion-input"
                                                                name="txtDireccion" placeholder="Ingrese su direccion"
                                                                value="{{$item->direccion}}" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection