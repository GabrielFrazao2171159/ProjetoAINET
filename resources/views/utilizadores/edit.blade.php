@extends('master')
@section('title','Editar Aeronave')
@section('content')
<form action="{{route('socios.update',$utilizador)}}" method="post" class="form-group">
	@method('put')
    @csrf
    @include('utilizadores.create-edit')   <!-- É assim a maneira correta?? -->
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <a href="{{route('socios.index')}}" class="btn btn-default">Cancel</a>
    </div>
</form>
@endsection
