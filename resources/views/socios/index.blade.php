@extends('master')
@section('title','Lista de Sócios')
@section('content')
<div>
    <a class="btn btn-primary" href="{{route('socios.create')}}">Adicionar sócio</a>
    <br><br>
    @can('gerirCotasAtivos', App\User::class) 
        <form action="{{route('socios.reset_quotas')}}" method="POST" role="form" class="inline">
            @method('patch')
            @csrf
            <button type="submit" class="btn btn btn-primary">Reset a cotas</button>
        </form>
        <br>
        <form action="{{route('socios.desativar_sem_quotas')}}" method="POST" role="form" class="inline">
            @method('patch')
            @csrf
            <button type="submit" class="btn btn btn-primary">Desativar sócios com quotas em atraso</button>
        </form>
    @endcan
</div>
<br>
<div>
    <form action="{{route('socios.index')}}" method="get">
		<fieldset>
			<legend>Pesquisar</legend>
			<input id="num_socio" value="" name="num_socio" type="text" 
			placeholder="Número de sócio">
			<input id="nome_informal" value="" name="nome_informal" type="text" 
			placeholder="Nome informal">
			<input id="email" value="" name="email" type="text" 
			placeholder="Email">
			<input id="tipo" value="" name="tipo" type="text" 
			placeholder="Tipo">
			<input id="direcao" value="" name="direcao" type="text" 
			placeholder="Direção">
			<input id="quotas_pagas" value="" name="quotas_pagas" type="text" 
			placeholder="Quotas pagas">
			<input id="ativo" value="" name="ativo" type="text" 
			placeholder="Ativo">
			<button class="btn btn-outline-success" type="submit">Pesquisar</button>
		</fieldset>
    </form>
</div>
<br>
@if (count($socios))
    <table class="table table-striped">
    <thead>
        <tr>
            <th></th>                 
            <th>Número de sócio</th>   
            <th>Nome</th>              
            <th>Email</th>             
            <th>Telefone</th>         
            <th>Tipo</th>               
            <th>Direção</th>            
            @can('verInfoDirecao', App\User::class)
                <th>Quotas pagas</th>
                <th>Ativo</th>
            @endcan
            <th>Nº de licença</th>   
            <th>Ações</th>    
            @can('gerirCotasAtivos', App\User::class)           
                <th>Opções</th>
            @endcan
        </tr>
    </thead>
    <tbody>
    @foreach ($socios as $socio)
        <tr>
            @if (!empty($socio->foto_url))
                <td><img src ="{{ asset('storage/fotos/' . $socio->foto_url) }}" class="rounded-circle" height=35px widht=35px></td>
            @else
                <td><img src ="{{ asset('storage/fotos/defaultPIC.jpg') }}" class="rounded-circle" height=35px widht=35px></td>
            @endif
            <td>{{($socio->num_socio)}}</td>
            <td>{{($socio->nome_informal)}}</td>
            <td>{{($socio->email)}}</td>
            <td>{{($socio->telefone)}}</td>
            <td>{{($socio->typeToStr())}}</td>
            <td>{{($socio->direcaoToStr())}}</td>
            @can('verInfoDirecao', App\User::class)
                <td>{{($socio->quotaToStr())}}</td>
                <td>{{($socio->ativoToStr())}}</td>
            @endcan
            @if($socio->tipo_socio=='P')
                @if($socio->num_licenca!=null)
                    <td>{{$socio->num_licenca}}</td>
                @else
                    <td>Não tem</td>
                @endif
            @else
                <td>Não tem(vazio??)</td>
            @endif
            <td>
                <a class="btn btn-xs btn-primary" href="{{route('socios.edit',$socio)}}">Editar</a>
                <form action="{{route('socios.destroy',$socio)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                </form>
            </td>
            @can('gerirCotasAtivos', App\User::class)
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
                    <form action="{{route('socios.ativo',$socio)}}" method="post" role="form" class="inline">
                        @method('patch')
                        @csrf
                        @if ($socio->ativo==0)
                            <button type="submit" class="btn btn-xs btn-primary">Ativar Sócio</button>
                        @else
                            <button type="submit" class="btn btn-xs btn-danger">Desativar Sócio</button>
                        @endif
                    </form>
                </td>
            @endcan
        </tr>
    @endforeach
    </table>
@else
    <h2>Não foram encontrados utilizadores</h2>
@endif
<div style="text-align: center;">{{ $socios->links() }}</div>
@endsection
