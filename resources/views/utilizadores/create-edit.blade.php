<div class="form-group">
    <label for="inputNumeroSocio">Número de sócio</label>
    <input
        type="number" class="form-control"
        name="num_socio" id="inputNumeroSocio" value="{{old('num_socio', $socio->num_socio)}}"/>
    @if ($errors->has('num_socio'))
        <em>{{ $errors->first('num_socio') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputNome">Nome</label>
    <input
        type="text" class="form-control"
        name="nome_informal" id="inputNome" value="{{old('nome_informal',$socio->nome_informal)}}"/>
    @if ($errors->has('nome_informal'))
        <em>{{ $errors->first('nome_informal') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input
        type="text" class="form-control"
        name="email" id="inputEmail" value="{{old('email',$socio->email)}}"/>
    @if ($errors->has('email'))
        <em>{{ $errors->first('email') }}</em>
    @endif 
</div>
<div class="form-group">
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
<div>
    <div class="form-group col-md-4">
        <label class="form-check-label" for="inputDirecao">Direção</label>
        <input 
        type="checkbox" class="form-check-input" 
        id="inputDirecao" name="direcao" value="{{old('direcao',$socio->direcao)}}"/>
        @if ($errors->has('direcao'))
            <em>{{ $errors->first('direcao') }}</em>
        @endif 
    </div>
    <div class="form-group col-md-4">
        <label class="form-check-label" for="inputQuotasPagas">Quotas pagas</label>
        <input
            type="checkbox" class="form-check-input"
            name="quotas_pagas" id="inputQuotasPagas" value="{{old('quotas_pagas',$socio->quotas_pagas)}}"/>
        @if ($errors->has('quotas_pagas'))
            <em>{{ $errors->first('quotas_pagas') }}</em>
        @endif 
    </div>
    <div class="form-group col-md-4">
        <label class="form-check-label" for="inputAtivo">Ativo</label>
        <input
            type="checkbox" class="form-check-input"
            name="ativo" id="inputAtivo" value="{{old('ativo',$socio->ativo)}}"/>
        @if ($errors->has('ativo'))
            <em>{{ $errors->first('ativo') }}</em>
        @endif 
    </div>
</div>
