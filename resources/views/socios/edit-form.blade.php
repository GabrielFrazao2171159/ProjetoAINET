<div>
    <div class="col-md-4 text-center">
        @if (!empty($socio->foto_url))
            <td><img src="{{ asset('storage/fotos/' . $socio->foto_url) }}" class="rounded-circle" height=350px
                     widht=350px style="border-radius: 15px"></td>
        @else
            <td><img src="{{ asset('storage/fotos/defaultPIC.jpg   ') }}" class="rounded-circle" height=350px
                     widht=350px style="border-radius: 15px"></td>
        @endif
        <br/><br/>
        <input type="file" name="file_foto" class="form-control">
        @if ($errors->has('file_foto'))
            <em>{{ $errors->first('file_foto') }}</em>
        @endif
    </div>
    <div class="col-md-8 text-center">
        @can('editInfo', App\User::class)
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
                <label for="inputTipo">Tipo</label>
                <select name="tipo_socio" id="tipo_socio" class="form-control">
                    <option disabled selected> -- Selecione uma opção --</option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'P' ? 'selected' : '' }} value="P">Piloto
                    </option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'NP' ? 'selected' : '' }} value="NP">Não piloto
                    </option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'A' ? 'selected' : '' }} value="A">
                        Aeromodelista
                    </option>
                </select>
                @if ($errors->has('tipo_socio'))
                    <em>{{ $errors->first('tipo_socio') }}</em>
                @endif
            </div>
            <div class="form-group">
                <label for="inputSexo">Sexo</label>
                <select name="sexo" id="sexo" class="form-control">
                    <option disabled selected> -- Selecione uma opção --</option>
                    <option {{ old('sexo',$socio->sexo) == 'M' ? 'selected' : '' }} value="M">Masculino</option>
                    <option {{ old('sexo',$socio->sexo) == 'F' ? 'selected' : '' }} value="F">Feminino</option>
                </select>
                @if ($errors->has('sexo'))
                    <em>{{ $errors->first('sexo') }}</em>
                @endif
            </div>
        @else
            <div class="form-group">
                <label for="inputNumeroSocio">Número de sócio</label>
                <input
                        type="number" class="form-control"
                        name="num_socio" id="inputNumeroSocio" value="{{old('num_socio', $socio->num_socio)}}"
                        readonly="readonly"/>
                @if ($errors->has('num_socio'))
                    <em>{{ $errors->first('num_socio') }}</em>
                @endif
            </div>
            <div class="form-group">
                <label for="inputTipo">Tipo</label>
                <select name="tipo_socio" id="tipo_socio" class="form-control" disabled>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'P' ? 'selected' : '' }} value="P">Piloto
                    </option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'NP' ? 'selected' : '' }} value="NP">Não Piloto
                    </option>
                    <option {{ old('tipo_socio',$socio->tipo_socio) == 'A' ? 'selected' : '' }} value="A">
                        Aeromodelista
                    </option>
                </select>
                @if ($errors->has('tipo_socio'))
                    <em>{{ $errors->first('tipo_socio') }}</em>
                @endif
            </div>
            <div class="form-group">
                <label for="inputSexo">Sexo</label>
                <select name="sexo" id="sexo" class="form-control" disabled>
                    <option {{ old('sexo',$socio->sexo) == 'M' ? 'selected' : '' }} value="M">Masculino</option>
                    <option {{ old('sexo',$socio->sexo) == 'F' ? 'selected' : '' }} value="F">Feminino</option>
                </select>
                @if ($errors->has('sexo'))
                    <em>{{ $errors->first('sexo') }}</em>
                @endif
            </div>
        @endcan
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <input
                    type="text" class="form-control"
                    name="name" id="inputNome" value="{{old('name',$socio->name)}}"/>
            @if ($errors->has('name'))
                <em>{{ $errors->first('name') }}</em>
            @endif
        </div>
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
            <label for="inputDataNascimento">Data Nascimento</label>
            <input
                    type="text" class="form-control"
                    name="data_nascimento" id="inputDataNascimento"
                    value="{{old('data_nascimento',$socio->data_nascimento)}}"/>
            @if ($errors->has('data_nascimento'))
                <em>{{ $errors->first('data_nascimento') }}</em>
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
            <label for="inputEndereco">Endereco</label>
            <textarea name="endereco" id="endereco" class="form-control">{{old('endereco',$socio->endereco)}}</textarea>
            @if ($errors->has('endereco'))
                <em>{{ $errors->first('endereco') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label for="inputNif">NIF</label>
            <input
                    type="number" class="form-control"
                    name="nif" id="inputNif" value="{{old('nif', $socio->nif)}}"/>
            @if ($errors->has('nif'))
                <em>{{ $errors->first('nif') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label for="inputTelefone">Telefone</label>
            <input
                    type="text" class="form-control"
                    name="telefone" id="inputTelefone" value="{{old('telefone', $socio->telefone)}}"/>
            @if ($errors->has('telefone'))
                <em>{{ $errors->first('telefone') }}</em>
            @endif
        </div>
        @can('editInfo', App\User::class)
            <div>
                <div class="form-group col-md-4">
                    <label class="form-check-label" for="inputDirecao">Direção</label>
                    <input
                            type="checkbox" class="form-check-input"
                            id="inputDirecao" name="direcao"
                            value="1" {{old('direcao',$socio->direcao) == 1 ? 'checked' : ''}}/>
                    @if ($errors->has('direcao'))
                        <em>{{ $errors->first('direcao') }}</em>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="form-check-label" for="inputQuotaPaga">Quotas pagas</label>
                    <input
                            type="checkbox" class="form-check-input"
                            name="quota_paga" id="inputQuotaPaga" value="1"
                            {{old('quota_paga',$socio->quota_paga) == 1 ? 'checked' : ''}}/>
                    @if ($errors->has('quota_paga'))
                        <em>{{ $errors->first('quota_paga') }}</em>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="form-check-label" for="inputAtivo">Ativo</label>
                    <input
                            type="checkbox" class="form-check-input"
                            name="ativo" id="inputAtivo"
                            value="1" {{old('ativo',$socio->ativo) == 1 ? 'checked' : ''}}/>
                    @if ($errors->has('ativo'))
                        <em>{{ $errors->first('ativo') }}</em>
                    @endif
                </div>
            </div>
        @else
            <div>
                <div class="form-group col-md-4">
                    <label class="form-check-label" for="inputDirecao">Direção</label>
                    <input
                            type="checkbox" class="form-check-input"
                            id="inputDirecao" name="direcao" disabled
                            value="1" {{old('direcao',$socio->direcao) == 1 ? 'checked' : ''}}/>
                    @if ($errors->has('direcao'))
                        <em>{{ $errors->first('direcao') }}</em>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="form-check-label" for="inputQuotaPaga">Quotas pagas</label>
                    <input
                            type="checkbox" class="form-check-input"
                            name="quota_paga" id="inputQuotaPaga" disabled value="1"
                            {{old('quota_paga',$socio->quota_paga) == 1 ? 'checked' : ''}}/>
                    @if ($errors->has('quota_paga'))
                        <em>{{ $errors->first('quota_paga') }}</em>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="form-check-label" for="inputAtivo">Ativo</label>
                    <input
                            type="checkbox" class="form-check-input"
                            name="ativo" id="inputAtivo" value="1"
                            disabled {{old('ativo',$socio->ativo) == 1 ? 'checked' : ''}}/>
                    @if ($errors->has('ativo'))
                        <em>{{ $errors->first('ativo') }}</em>
                    @endif
                </div>
            </div>
        @endcan
        {{--        Informacao do socio piloto, ainda sem polices --}}
        <div class="form-group">
            <label for="inputNumLicenca">Número Licença</label>
            <input
                    type="number" class="form-control"
                    name="num_licenca" id="inputNumLicenca" value="{{old('num_licenca', $socio->num_licenca)}}"/>
            @if ($errors->has('num_licenca'))
                <em>{{ $errors->first('num_licenca') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label for="inputTipoLicenca">Tipo Licença</label>
            <input
                    type="text" class="form-control"
                    name="tipo_licenca" id="inputTipoLicenca"
                    value="{{old('tipo_licenca', $socio->tipo_licenca)}}"/>
            @if ($errors->has('tipo_licenca'))
                <em>{{ $errors->first('tipo_licenca') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label class="form-check-label" for="inputInstrutor">Instrutor</label>
            <input
                    type="checkbox" class="form-check-input"
                    name="instrutor" id="inputInstrutor" value="1"
                    {{old('instrutor',$socio->instrutor) == 1 ? 'checked' : ''}}/>
            @if ($errors->has('instrutor'))
                <em>{{ $errors->first('instrutor') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label class="form-check-label" for="inputLicencaConfirmada">Licença confirmada</label>
            <input
                    type="checkbox" class="form-check-input"
                    name="licenca_confirmada" id="inputLicencaConfirmada" value="1"
                    {{old('licenca_confirmada',$socio->licenca_confirmada) == 1 ? 'checked' : ''}}/>
            @if ($errors->has('licenca_confirmada'))
                <em>{{ $errors->first('licenca_confirmada') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label class="form-check-label" for="inputCertificadoConfirmado">Certificado médico confirmado</label>
            <input
                    type="checkbox" class="form-check-input"
                    name="certificado_confirmado" id="inputCertificadoConfirmado" value="1"
                    {{old('certificado_confirmado',$socio->certificado_confirmado) == 1 ? 'checked' : ''}}/>
            @if ($errors->has('certificado_confirmado'))
                <em>{{ $errors->first('certificado_confirmado') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label for="inputValidadeLicenca">Validade Licença</label>
            <input
                    type="date" class="form-control"
                    name="validade_licenca" id="inputValidadeLicenca"
                    value="{{old('validade_licenca',$socio->validade_licenca)}}"/>
            @if ($errors->has('validade_licenca'))
                <em>{{ $errors->first('validade_licenca') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label for="inputNumCertificado">Número Certificado</label>
            <input
                    type="text" class="form-control"
                    name="num_certificado" id="inputNumCertificado"
                    value="{{old('num_certificado', $socio->num_certificado)}}"/>
            @if ($errors->has('num_certificado'))
                <em>{{ $errors->first('num_certificado') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label for="inputCertificadoConfirmado">Validade certificado médico</label>
            <input
                    type="date" class="form-control"
                    name="validade_certificado" id="inputCertificadoConfirmado"
                    value="{{old('validade_certificado',$socio->validade_certificado)}}"/>
            @if ($errors->has('validade_certificado'))
                <em>{{ $errors->first('validade_certificado') }}</em>
            @endif
        </div>
        <div class="form-group">
            <label for="inputClasseCertificado">Classe Certificado</label>
            <input
                    type="text" class="form-control"
                    name="classe_certificado" id="inputClasseCertificado"
                    value="{{old('classe_certificado', $socio->classe_certificado)}}"/>
            @if ($errors->has('classe_certificado'))
                <em>{{ $errors->first('classe_certificado') }}</em>
            @endif
        </div>
        <div>
            <label>Cópia digital da licença</label>
            <div>
                @if($socio->licenca_confirmada==1)
                    <a href="{{  route('socios.licenca', $socio) }}">Ver licença</a>
                @endif
            </div>
            <input type="file" name="file_licenca" class="form-control">{{--cópia digital da licença--}}
        </div>
        <label>Cópia digital do certificado</label>
        <div>
            @if($socio->certificado_confirmado==1)
                <a href="{{  route('socios.certificado', $socio) }}">Ver certificado</a>
            @endif
        </div>
        <input type="file" name="file_certificado" class="form-control">{{--cópia digital do certificado--}}
    </div>
</div>
