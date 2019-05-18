@extends('master')
@section('title','Adicionar Voo')
@section('content')
    <form action="{{route('movimentos.store')}}" method="post" class="form-group">
        @csrf
        @include('movimentos.create-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
            <a href="{{route('movimentos.index')}}" class="btn btn-default">Cancelar</a>
        </div>
    </form>
@endsection