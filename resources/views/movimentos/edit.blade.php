@extends('master')
@section('title','Editar Movimento')
@section('content')
    <form action="{{route('movimentos.update',$movimento)}}" method="post" class="form-group">
        @method('put')
        @csrf
        @include('movimentos.create-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('movimentos.index')}}" class="btn btn-default">Cancel</a>
        </div>
    </form>
@can('confimarVoo', App\Movimento::class)
    @if ($movimento->confirmado == 0)
        <form action="{{route('movimentos.update', $movimento)}}" method="post">
            @method('put')
            @csrf
            <input type="hidden" name="confirmar" value="1" />
            <button type="submit" class="btn btn-primary">Confirmar Movimento</button>
        </form>
    @endif
@endcan
@endsection

