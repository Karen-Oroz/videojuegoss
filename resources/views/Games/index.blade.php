@extends('layout')
@section('title')
    - Listado
@endsection 
@section('body')
    @if($msj = Session::get('success'))
    <div class="row" id="alerta">
        <div class="col-md-4 offset-md-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><i class="fa-solid fa-check"></i> {{$msj}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="table-responsive shadow-sm rounded-lg">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>NIVELES</th>
                            <th>LANZAMIENTO</th>
                            <th>IMAGEN</th>
                            <th colspan="2" class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $i => $row)
                        <tr>
                            <td>{{ ($i+1) }}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->levels}}</td>
                            <td>{{$row->release}}</td>
                            <td>
                                <img class="img-fluid rounded-3" width="120" src="storage/{{ $row->image}}">
                            </td>
                            <td class="text-center">
                                <a class="btn btn-warning" href="{{route('games.edit',$row->id)}}">
                                    <i class="fa-solid fa-edit"></i> Editar
                                </a>
                            </td>
                            <td class="text-center">
                                <form id="frm_{{$row->id}}" method="POST" action="{{route('games.destroy',$row->id)}}">
                                    @method('DELETE')
                                    @csrf 
                                    <button data-bs-toggle="modal" data-bs-target="#modalConfirmacion"
                                    onclick="setInfo({{$row->id}}, '{{$row->name}}')" 
                                    type="button" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="modalConfirmacion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿Seguro que deseas eliminar?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><i class="fa-solid fa-warning fs-3 text-warning"></i>
                        <label id="lbl_nombre"></label>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="btnEliminar" type="button" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @vite('resources/js/Games/index.js')
@endsection
