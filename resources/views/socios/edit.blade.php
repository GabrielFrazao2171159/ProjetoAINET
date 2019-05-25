@extends('master')
@section('title','Editar Sócio')
@section('content')
<form method="POST" action="{{route('socios.update',$socio)}}" enctype="multipart/form-data">
	<input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" value="{{intval($socio->id)}}">
    @include('socios.edit-form')  
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <a href="{{route('socios.index')}}" class="btn btn-default">Cancel</a>

    </div>
</form>
@can('enviarMail', App\User::class) 
    @if ($socio->email_verified_at == null)
        <form action="{{route('socios.reenviarEmail', $socio)}}" method="post">
            @csrf
            <input type="hidden" name="reenviarID" value="{{$socio->id}}" />
            <button type="submit" class="btn btn-primary">Reenviar email</button>
        </form>
    @endif
@endcan
@endsection
