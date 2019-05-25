@extends('master')
@section('title','Editar Aeronave')
@section('content')
<form action="{{route('aeronaves.update',$aeronave)}}" method="post" class="form-group">
	@method('put')
    @csrf
    <div class="form-group">
    	<label for="inputMatricula">Matricula</label>
        <input type="text" class="form-control" name="matricula" id="inputMatricula" 
        value="{{old('matricula',$aeronave->matricula)}}" readonly="readonly" />
    </div>
    @include('aeronaves.create-edit')  
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <a href="{{route('aeronaves.index')}}" class="btn btn-default">Cancel</a>
    </div>
</form>
@endsection
