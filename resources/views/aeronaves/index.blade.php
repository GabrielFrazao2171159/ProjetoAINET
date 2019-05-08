@extends('master')
@section('title','Lista de Aeronaves')
@section('content')
<div><a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar aeronave</a></div>
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
                <a class="btn btn-xs btn-primary" href="{{route('aeronaves.edit',$aeronave)}}">Editar</a>
                <form action="{{route('aeronaves.destroy',$aeronave)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>       
    @endforeach
    </table>
@else 
    <h2>Não foram encontradas aeronaves</h2>
@endif
@endsection
