@extends('master')
@section('title','Editar Sócio')
@section('content')
<form action="{{route('socios.update',$socio)}}" method="post" class="form-group">
	@method('put')
    @csrf
    @include('socios.create-edit')  
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <a href="{{route('socios.index')}}" class="btn btn-default">Cancel</a>
        @if ($socio->email_verified_at)=='null'
            <a href="#" class="btn btn-default">Reenviar email</a>
        @endif
    </div>
</form>
@endsection
