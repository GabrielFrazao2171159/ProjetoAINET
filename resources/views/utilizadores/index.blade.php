@extends('master')
@section('title','Lista de Sócios')
@section('content')
<div><a class="btn btn-primary" href="{{route('socios.create')}}">Adicionar sócio</a></div>
@if (count($socios))
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
    @foreach ($socios as $socio)
        <tr>
            <td>{{($socio->num_socio)}}</td>
            <td>{{($socio->nome_informal)}}</td>
            <td>{{($socio->email)}}</td>
            <td>{{($socio->tipo_socio)}}</td>
            <td>{{($socio->direcao)}}</td>
            <td>{{($socio->quota_paga)}}</td>
            <td>{{($socio->ativo)}}</td>
            <td>
                <a class="btn btn-xs btn-primary" href="{{route('socios.edit',$socio)}}">Editar</a>
                <form action="{{route('socios.destroy',$socio)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="id" value="<?=($socio->id)?>">
                    <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>Não foram encontrados utilizadores</h2>
@endif
<div style="text-align: center;">{{ $socios->links() }}</div>
@endsection
