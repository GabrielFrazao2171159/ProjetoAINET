@extends('master')
@section('title','Lista de Aeronaves')
@section('content')
@can('create', App\Aeronave::class)
<div><a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar aeronave</a></div>
@endcan
@if (count($aeronaves))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Matricula</th>            
            <th>Marca</th>
            <th>Modelo</th>
            <th>Número de lugares</th>
            <th>Conta Horas</th>
            <th>Preço Hora</th>
            <th>Pilotos Autorizados</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($aeronaves as $aeronave)
        <tr>
            <td>{{($aeronave->matricula)}}</td>
            <td>{{($aeronave->marca)}}</td>
            <td>{{($aeronave->modelo)}}</td>
            <td>{{$aeronave->num_lugares}}</td>
            <td>{{$aeronave->conta_horas}}</td>
            <td>{{$aeronave->preco_hora}}</td>
            <td><a href="{{route('aeronaves.pilotosAutorizados',$aeronave)}}">Listagem</a></td>
            <td>
                @can('update', App\Aeronave::class)
                <a class="btn btn-xs btn-primary" href="{{route('aeronaves.edit',$aeronave)}}">Editar</a>
                @endcan
                @can('delete', App\Aeronave::class)
                <form action="{{route('aeronaves.destroy',$aeronave)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                </form>
                @endcan
            </td>
        </tr>       
    @endforeach
    </table>
@else 
    <h2>Não foram encontradas aeronaves</h2>
@endif
@endsection
