<div>
    <div class="col-md-4 text-center">
        <img src="{{ $socio->foto_url == null ? asset('storage/img/noimage.jpg') : asset('storage/img/' . $socio->foto_url)}}" class="img-thumbnail"/>

        <br/><br/>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="col-md-8 text-center">
        <div class="form-group">
            <label for="inputNumeroSocio">Número de sócio</label>
            <input
                type="number" class="form-control"
                name="num_socio" id="inputNumeroSocio" value="{{old('num_socio', $socio->num_socio)}}"/>
            @if ($errors->has('num_socio'))
                <em>{{ $errors->first('num_socio') }}</em>
            @endif
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="inputNomeInformal">Nome</label>--}}
{{--            <input--}}
{{--                    type="text" class="form-control"--}}
{{--                    name="nome_informal" id="inputNomeInformal" value="{{old('nome',$socio->nome)}}"/>--}}
{{--            @if ($errors->has('nome_informal'))--}}
{{--                <em>{{ $errors->first('nome_informal') }}</em>--}}
{{--            @endif--}}
{{--        </div>--}}
        <div class="form-group">
            <label for="inputNomeInformal">Nome Informal</label>
            <input
                type="text" class="form-control"
                name="nome_informal" id="inputNomeInformal" value="{{old('nome_informal',$socio->nome_informal)}}"/>
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
                <select name="tipo_socio" id="tipo_socio" class="form-control">
                    <option disabled selected> -- Selecione uma opção -- </option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'P' ? 'selected' : '' }} value="P">Piloto</option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'NP' ? 'selected' : '' }} value="NP">Não piloto</option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'A' ? 'selected' : '' }} value="A">Aeromodelista</option>
                </select>
                @if ($errors->has('tipo_socio'))
                    <em>{{ $errors->first('tipo_socio') }}</em>
                @endif 
        </div>
        {{print_r($socio)}}
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
{{--        <div class="form-group">--}}
{{--            <label for="inputNumeroSocio"></label>--}}
{{--            <input--}}
{{--                    type="number" class="form-control"--}}
{{--                    name="num_socio" id="inputNumeroSocio" value="{{old('num_socio', $socio->num_socio)}}"/>--}}
{{--            @if ($errors->has('num_socio'))--}}
{{--                <em>{{ $errors->first('num_socio') }}</em>--}}
{{--            @endif--}}
{{--        </div>--}}
    </div>
</div>