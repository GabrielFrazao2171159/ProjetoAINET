@extends('master')
@section('title', 'Lista de Voos')
@section('content')
<div><a class="btn btn-primary" href="{{route('movimentos.create')}}">Adicionar voo</a></div>
@if (count($movimentos))
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th> 
            <th>Aeronave</th>
            <th>Data</th>
            <th>Hora descolagem</th>
            <th>Hora aterragem</th>
            <th>Tempo voo</th>
            <th>Natureza</th>
            <th>Piloto</th>
            <th>Aeródromo partida</th>
            <th>Aeródromo chegada</th>
            <th>Nº aterragens</th>
            <th>Nº descolagens</th>
            <th>Nº diário</th>
            <th>Nº serviço</th>
            <th>Conta horas inicial</th>
            <th>Conta horas final</th>
            <th>Nº pessoas</th>
            <th>Tipo instrução</th>
            <th>Instrutor</th>
            <th>Confirmado</th>
            <th>Observações</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($movimentos as $movimento)
        <tr>
            <td>{{($movimento->id)}}</td>
            <td>{{App\Aeronave::find($movimento->aeronave)->matricula}}</td>
            <td>{{date("d/m/Y", strtotime($movimento->data))}}</td>
            <td>{{date("H:i", strtotime($movimento->hora_descolagem))}}</td>
            <td>{{date("H:i", strtotime($movimento->hora_aterragem))}}</td>
            <td>{{$movimento->tempo_voo}}</td>
            <td>{{$movimento->typeToStr()}}</td>
            <td>{{$movimento->piloto->nome_informal}}</td>
            <td>{{$movimento->aerodromo_partida}}</td>
            <td>{{$movimento->aerodromo_chegada}}</td>
            <td>{{$movimento->num_aterragens}}</td>
            <td>{{$movimento->num_descolagens}}</td>
            <td>{{$movimento->num_diario}}</td>
            <td>{{$movimento->num_servico}}</td>
            <td>{{$movimento->conta_horas_inicio}}</td>
            <td>{{$movimento->conta_horas_fim}}</td>
            <td>{{$movimento->num_pessoas}}</td>
            <td>{{$movimento->hasInstrucao($movimento->tipo_instrucao)}}</td>
            <td>{{$movimento->hasPiloto($movimento->instrutor_id)}}</td>
            <td>@if ($movimento->confirmado == 1)
                <img src ="{{ asset('storage/fotos/confirmado1.png') }}" class="rounded-circle" height=42px widht=42px>
                @else
                <img src ="{{ asset('storage/fotos/confirmado2.png') }}" class="rounded-circle" height=35px widht=35px>
                @endif
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