@extends('master')
@section('title','Lista de Pilotos Não Autorizados')
@section('content')
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
             
            </td>
        </tr>       
    @endforeach
    </table>
@else 
    <h2>Não foram encontradas pilotos não autorizados</h2>
@endif
<div style="text-align: center;">{{ $pilotos->links() }}</div>
@endsection
