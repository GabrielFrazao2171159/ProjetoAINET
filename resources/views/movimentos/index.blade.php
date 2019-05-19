@extends('master')
@section('title', 'Lista de Voos')
@section('content')
<div><a class="btn btn-primary" href="{{route('movimentos.create')}}">Adicionar voo</a></div>
@if (count($movimentos))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th> 
            <th>Data</th>
            <th>Hora de descolagem</th>
            <th>Hora de aterragem</th>
            <th>Aeronave</th>
            <th>Piloto</th>
            <th>Instrutor</th>
            <th>Natureza</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($movimentos as $movimento)
        <tr>
            <td>{{($movimento->id)}}</td>
            <td>{{($movimento->data)}}</td>
            <td>{{date("H:i", strtotime($movimento->hora_descolagem))}}</td>
            <td>{{date("H:i", strtotime($movimento->hora_aterragem))}}</td>
            <td>
            <p>{{App\Aeronave::find($movimento->aeronave)->matricula}}</p>
            <p>{{App\Aeronave::find($movimento->aeronave)->marca}}</p>
            <p>{{App\Aeronave::find($movimento->aeronave)->modelo}}</p>
            </td>
            <td>{{$movimento->piloto->name}}</td>
            <td>{{$movimento->hasPiloto($movimento->instrutor_id)}}</td>
            <td>{{$movimento->typeToStr()}}</td>
            <td>
            <a class="btn btn-xs btn-primary" href="{{route('movimentos.edit',$movimento)}}">Editar</a>
            <form action="{{route('movimentos.destroy',$movimento)}}" method="POST" role="form" class="inline">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
            </form>
            </td>
        </tr> 
    @endforeach
    </table>
@else 
    <h2>Não foram encontradas voos</h2>
@endif
<div style="text-align: center;">{{ $movimentos->links() }}</div>
@endsection