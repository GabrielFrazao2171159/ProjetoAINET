@extends('master')
@section('title','Adicionar Voo')
@section('content')
    <form action="{{route('movimentos.store',$movimento)}}" method="post" class="form-group">
        @method('post')
        @csrf
        @include('movimentos.create-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
            <a href="{{route('movimentos.index')}}" class="btn btn-default">Cancelar</a>
        </div>
    </form>
@endsection