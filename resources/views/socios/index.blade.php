@extends('master')
@section('title','Lista de Sócios')
@section('content')
<div>
    <a class="btn btn-primary" href="{{route('socios.create')}}">Adicionar sócio</a>
    <br>
    <form action="{{route('socios.reset_quotas')}}" method="POST" role="form" class="inline">
        @method('patch')
        @csrf
        <button type="submit" class="btn btn btn-primary">Reset a cotas</button>
    </form>
</div>
<div>
    <form action="/alunos" class="form-inline my-2 my-lg-0" method="get">
        <input id="search" value="{{ request()->get('search') }}" name="search"
               class="form-control mr-sm-2" type="search" placeholder="Pesquisar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <p></p>
</div>
@if (count($socios))
    <table class="table table-striped">
    <thead>
        <tr>
            <th></th>    
            <th>Número de sócio</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Direção</th>
            <th>Quotas pagas</th>
            <th>Ativo</th>
            <th>Ações</th>
            <th>Quotas</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($socios as $socio)
        <tr>
            <td>{{($socio->foto_url)}}</td>
            <td>{{($socio->num_socio)}}</td>
            <td>{{($socio->nome_informal)}}</td>
            <td>{{($socio->email)}}</td>
            <td>{{($socio->typeToStr())}}</td>
            <td>{{($socio->direcaoToStr())}}</td>
            <td>{{($socio->quotaToStr())}}</td>
            <td>{{($socio->ativoToStr())}}</td>
            <td>
                <a class="btn btn-xs btn-primary" href="{{route('socios.edit',$socio)}}">Editar</a>
                <form action="{{route('socios.destroy',$socio)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                </form>
            </td>
            <td>
                <form action="{{route('socios.quotas',$socio)}}" method="post" role="form" class="inline">
                    @method('patch')
                    @csrf
                    @if ($socio->quota_paga==0)
                        <button type="submit" class="btn btn-xs btn-primary">Quota paga</button>
                    @else
                        <button type="submit" class="btn btn-xs btn-danger">Quota não paga</button>
                    @endif
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>Não foram encontrados utilizadores</h2>
@endif
<div style="text-align: center;">{{ $socios->links() }}</div>
@endsection
