@extends('master')
@section('title','Adicionar Aeronave')
@section('content')
<form action="{{route('aeronaves.store')}}" method="post" class="form-group">
    @csrf
    @include('aeronaves.create-edit')	<!-- É assim a maneira correta?? -->
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
        <a href="{{route('aeronaves.index')}}" class="btn btn-default">Cancelar</a>
    </div>
</form>
@endsection