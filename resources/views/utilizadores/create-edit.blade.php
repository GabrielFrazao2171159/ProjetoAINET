<div class="form-group">
    <label for="inputNumeroSocio">Número de sócio</label>
    <input
        type="number" class="form-control"
        name="num_socio" id="inputNumeroSocio" value="{{old('num_socio', $utilizador->num_socio)}}"/>
    @if ($errors->has('num_socio'))
        <em>{{ $errors->first('num_socio') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputNome">Nome</label>
    <input
        type="text" class="form-control"
        name="nome_informal" id="inputNome" value="{{old('nome_informal',$utilizador->nome_informal)}}"/>
    @if ($errors->has('nome_informal'))
        <em>{{ $errors->first('nome_informal') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input
        type="text" class="form-control"
        name="email" id="inputEmail" value="{{old('email',$utilizador->email)}}"/>
    @if ($errors->has('email'))
        <em>{{ $errors->first('email') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputTipo">Tipo</label>
    <input
        type="number" class="form-control"
        name="tipo" id="inputTipo" value="{{old('tipo',$utilizador->tipo)}}"/>
    @if ($errors->has('tipo'))
        <em>{{ $errors->first('tipo') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputDirecao">Direção</label>
    <input
        type="text" class="form-control"
        name="direcao" id="inputDirecao" value="{{old('direcao',$utilizador->direcao)}}"/>
    @if ($errors->has('direcao'))
        <em>{{ $errors->first('direcao') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputQuotasPagas">Quotas pagas</label>
    <input
        type="text" class="form-control"
        name="quotas_pagas" id="inputQuotasPagas" value="{{old('quotas_pagas',$utilizador->quotas_pagas)}}"/>
    @if ($errors->has('quotas_pagas'))
        <em>{{ $errors->first('quotas_pagas') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputAtivo">Ativo</label>
    <input
        type="text" class="form-control"
        name="ativo" id="inputAtivo" value="{{old('ativo',$utilizador->ativo)}}"/>
    @if ($errors->has('ativo'))
        <em>{{ $errors->first('ativo') }}</em>
    @endif 
</div>