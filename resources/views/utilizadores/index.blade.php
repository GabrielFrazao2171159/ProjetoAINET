@extends('master')
@section('title','Lista de Sócios')
@section('content')
<div><a class="btn btn-primary" href="{{route('socios.index')}}">Adicionar sócio</a></div>
@if (count($utilizadores))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Número de sócio</th>            
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Direção</th>
            <th>Quotas pagas</th>
            <th>Ativo</th>   
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($utilizadores as $utilizador)
        <tr>
            <td>{{($utilizador->num_socio)}}</td>
            <td>{{($utilizador->nome_informal)}}</td>
            <td>{{($utilizador->email)}}</td>
            <td>{{$utilizador->tipo_socio}}</td>
            <td>{{$utilizador->direcao}}</td>
            <td>{{$utilizador->quota_paga}}</td>
            <td>{{$utilizador->ativo}}</td>
            <td>
                <a class="btn btn-xs btn-primary" href="{{route('socios.edit',$utilizador)}}">Editar</a>
                <form action="{{route('socios.destroy',$utilizador)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="id" value="<?=($utilizador->id)?>">
                    <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>       
    @endforeach
    </table>
@else 
    <h2>Não foram encontrados utlizadores</h2>
@endif
@endsection
