@extends('master')
@section('title','Adicionar Sócio')
@section('content')
<form action="{{route('socios.store')}}" method="post" class="form-group">
    @csrf
    <div class="form-group">
        <div>
            <div class="form-group col-md-2">
                <label for="inputNumeroSocio">Número de sócio</label>
                <input
                        type="number" class="form-control"
                        name="num_socio" id="inputNumeroSocio" value="{{old('num_socio', $socio->num_socio)}}"/>
                @if ($errors->has('num_socio'))
                    <em>{{ $errors->first('num_socio') }}</em>
                @endif
            </div>
            <div class="form-group col-md-7">
                <label for="inputName">Nome</label>
                <input
                        type="text" class="form-control"
                        name="name" id="inputName" value="{{old('name', $socio->name)}}"/>
                @if ($errors->has('name'))
                    <em>{{ $errors->first('name') }}</em>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="inputNomeInformal">Nome Informal</label>
                <input
                        type="text" class="form-control"
                        name="nome_informal" id="inputNomeInformal" value="{{old('nome_informal', $socio->nome_informal)}}"/>
                @if ($errors->has('nome_informal'))
                    <em>{{ $errors->first('nome_informal') }}</em>
                @endif
            </div>
        </div>
        <div>
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input
                        type="text" class="form-control"
                        name="email" id="inputEmail" value="{{old('email', $socio->email)}}"/>
                @if ($errors->has('email'))
                    <em>{{ $errors->first('email') }}</em>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword">Password</label>
                <input
                        type="text" class="form-control"
                        name="password" id="password" value="{{old('password', $socio->password)}}"/>
                @if ($errors->has('password'))
                    <em>{{ $errors->first('password') }}</em>
                @endif
            </div>
        </div>
        <div>
            <div class="form-group col-md-4">
                <label for="inputDataNascimento">Data Nascimento</label>
                <input
                        type="Date" class="form-control"
                        name="data_nascimento" id="inputDataNascimento" value="{{old('data_nascimento', $socio->data_nascimento)}}"/>
                @if ($errors->has('data_nascimento'))
                    <em>{{ $errors->first('data_nascimento') }}</em>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="inputSexo">Sexo</label>
                <select name="sexo" id="inputSexo" class="form-control">
                    <option disabled selected> -- Selecione uma opção -- </option>
                    <option {{ old('sexo',$socio->sexo) == 'F' ? 'selected' : '' }} value="F">Feminino</option>
                    <option {{ old('sexo',$socio->sexo) == 'M' ? 'selected' : '' }} value="M">Masculino</option>
                </select>
                @if ($errors->has('sexo'))
                    <em>{{ $errors->first('sexo') }}</em>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="inputTipo">Tipo</label>
                <select name="tipo" id="inputTipo" class="form-control">
                    <option disabled selected> -- Selecione uma opção -- </option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'P' ? 'selected' : '' }} value="P">Piloto</option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'NP' ? 'selected' : '' }} value="NP">Não piloto</option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'A' ? 'selected' : '' }} value="A">Aeromodelista</option>
                </select>
                @if ($errors->has('tipo'))
                    <em>{{ $errors->first('tipo') }}</em>
                @endif
            </div>
        </div>
        <div>
            <div class="form-group col-md-4">
                <label class="form-check-label" for="inputDirecao">Direção</label>
                <input
                        type="checkbox" class="form-check-input"
                        id="inputDirecao" name="direcao" {{old('direcao',$socio->direcao) == 1 ? 'checked' : ''}}/>
                @if ($errors->has('direcao'))
                    <em>{{ $errors->first('direcao') }}</em>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label class="form-check-label" for="inputQuotaPaga">Quotas pagas</label>
                <input
                        type="checkbox" class="form-check-input"
                        name="quota_paga" id="inputQuotaPaga"
                        {{old('quota_paga',$socio->quota_paga) == 1 ? 'checked' : ''}}/>
                @if ($errors->has('quota_paga'))
                    <em>{{ $errors->first('quota_paga') }}</em>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label class="form-check-label" for="inputAtivo">Ativo</label>
                <input
                        type="checkbox" class="form-check-input"
                        name="ativo" id="inputAtivo" {{old('ativo',$socio->ativo) == 1 ? 'checked' : ''}}/>
                @if ($errors->has('ativo'))
                    <em>{{ $errors->first('ativo') }}</em>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success" name="ok">Adicionar</button>
            <a href="{{route('socios.index')}}" class="btn btn-default">Cancelar</a>
        </div>
    </div>
</form>
@endsection