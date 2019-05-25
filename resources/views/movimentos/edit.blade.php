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
@endsection

