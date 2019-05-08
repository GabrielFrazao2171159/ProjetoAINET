@extends('master')
@section('title','Lista de Pilotos Autorizados')
@section('content')
<!-- <div><a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar aeronave</a></div> -->
@if (count($pilotos))
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
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($pilotos as $piloto)
        <tr>
            <td>{{($piloto->num_socio)}}</td>
            <td>{{($piloto->nome_informal)}}</td>
            <td>{{($piloto->email)}}</td>
            <td>{{($piloto->tipo_socio)}}</td>
            <td>{{($piloto->direcao)}}</td>
            <td>{{($piloto->quota_paga)}}</td>
            <td>{{($piloto->ativo)}}</td>
            <td>
                <form action="{{route('aeronaves.adicionarPiloto',[$aeronave,$piloto])}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Não Autorizar</button>
                </form>
            </td>
        </tr>       
    @endforeach
    </table>
@else 
    <h2>Não foram encontradas pilotos autorizados</h2>
@endif
<div style="text-align: center;">{{ $pilotos->links() }}</div>
@endsection
