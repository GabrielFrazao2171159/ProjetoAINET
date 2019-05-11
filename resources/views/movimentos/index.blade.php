@extends('master')
@section('title', 'Lista de Voos')
@section('content')
@if (count($movimentos))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th> 
            <th>Data</th>
            <th>Hora de descolagem</th>
            <th>Hora de aterragem</th>
            <th>Aeronave</th>
            <th>Natureza</th>
            <th>Piloto</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($movimentos as $movimento)
        <tr>
            <td>{{($movimento->id)}}</td>
            <td>{{($movimento->data)}}</td>
            <td>{{($movimento->hora_descolagem)}}</td>
            <td>{{($movimento->hora_aterragem)}}</td>
            <td>{{($movimento->aeronave)}}</td>
            <td>{{($movimento->natureza)}}</td>
            <td>{{$movimento->piloto_id}}</td>
        </tr> 
    @endforeach
    </table>
@else 
    <h2>Não foram encontradas voos</h2>
@endif
<div style="text-align: center;">{{ $movimentos->links() }}</div>
@endsection