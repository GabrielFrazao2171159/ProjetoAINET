@extends('master')
@section('title','Adicionar Sócio')
@section('content')
<form action="{{route('socios.store')}}" method="post" class="form-group">
    @csrf
    @include('socios.create-edit')	
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
        <a href="{{route('socios.index')}}" class="btn btn-default">Cancelar</a>
    </div>
</form>
@endsection