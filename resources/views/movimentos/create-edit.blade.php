<div>
    <div class="form-group">
        <label for="inputData">Data</label>
        <input
                type="date" class="form-control"
                name="data" id="inputData" value="{{old('data',$movimento->data)}}"/>
        @if ($errors->has('data'))
            <em>{{ $errors->first('data') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputHoraDescolagem">Hora de Descolagem</label>
        <input
                type="time" class="form-control"
                name="hora_descolagem" id="inputHoraDescolagem" value="{{old('hora_descolagem',$movimento->hora_descolagem)}}"/>
        @if ($errors->has('hora_descolagem'))
            <em>{{ $errors->first('hora_descolagem') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputHoraAterragem">Hora de Aterragem</label>
        <input
                type="time" class="form-control"
                name="hora_aterragem" id="inputHoraAterragem" value="{{old('hora_aterragem',$movimento->hora_aterragem)}}"/>
        @if ($errors->has('hora_aterragem'))
            <em>{{ $errors->first('hora_aterragem') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputAeronave">Aeronave</label>
        <input
                type="text" class="form-control"
                name="aeronave" id="inputAeronave" value="{{old('aeronave',$movimento->aeronave)}}"/>
        @if ($errors->has('aeronave'))
            <em>{{ $errors->first('aeronave') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumDiario">Nº Diário</label>
        <input
                type="text" class="form-control"
                name="num_diario" id="inputNumDiario" value="{{old('num_diario',$movimento->num_diario)}}"/>
        @if ($errors->has('num_diario'))
            <em>{{ $errors->first('num_diario') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumServico">Nº Serviço</label>
        <input
                type="text" class="form-control"
                name="num_servico" id="inputNumServico" value="{{old('num_servico',$movimento->num_servico)}}"/>
        @if ($errors->has('num_servico'))
            <em>{{ $errors->first('num_servico') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputPiloto">Piloto ID</label>
        <input
                type="text" class="form-control"
                name="piloto_id" id="inputPiloto" value="{{old('piloto_id',$movimento->piloto_id)}}"/>
        @if ($errors->has('piloto_id'))
            <em>{{ $errors->first('piloto_id') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNatureza">Natureza</label>
        <select name="natureza" id="inputNatureza" class="form-control">
            <option disabled selected> -- Selecione uma opção -- </option>
            <option {{ old('natureza',$movimento->natureza) == 'T' ? 'selected' : '' }} value="T">Treino</option>
            <option {{ old('natureza',$movimento->natureza) == 'I' ? 'selected' : '' }} value="I">Instrução</option>
            <option {{ old('natureza',$movimento->natureza) == 'E' ? 'selected' : '' }} value="E">Especial</option>
        </select>
        @if ($errors->has('natureza'))
            <em>{{ $errors->first('natureza') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputAerodromoPartida">Aeródromo de Partida</label>
        <input
                type="text" class="form-control"
                name="aerodromo_partida" id="inputAerodromoPartida" value="{{old('aerodromo_partida',$movimento->aerodromo_partida)}}"/>
        @if ($errors->has('aerodromo_partida'))
            <em>{{ $errors->first('aerodromo_partida') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputAerodromoChegada">Aeródromo de Partida</label>
        <input
                type="text" class="form-control"
                name="aerodromo_chegada" id="inputAerodromoChegada" value="{{old('aerodromo_chegada',$movimento->aerodromo_chegada)}}"/>
        @if ($errors->has('aerodromo_chegada'))
            <em>{{ $errors->first('aerodromo_chegada') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumAterragens">Nº Aterragens</label>
        <input
                type="text" class="form-control"
                name="num_aterragens" id="inputNumAterragens" value="{{old('num_aterragens',$movimento->num_aterragens)}}"/>
        @if ($errors->has('num_aterragens'))
            <em>{{ $errors->first('num_aterragens') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumDescolagens">Nº Descolagens</label>
        <input
                type="text" class="form-control"
                name="num_descolagens" id="inputNumDescolagens" value="{{old('num_descolagens',$movimento->num_descolagens)}}"/>
        @if ($errors->has('num_descolagens'))
            <em>{{ $errors->first('num_descolagens') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumPessoas">Nº Pessoas</label>
        <input
                type="text" class="form-control"
                name="num_pessoas" id="inputNumPessoas" value="{{old('num_pessoas',$movimento->num_pessoas)}}"/>
        @if ($errors->has('num_pessoas'))
            <em>{{ $errors->first('num_pessoas') }}</em>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumPessoas">Nº Pessoas</label>
        <input
                type="text" class="form-control"
                name="num_pessoas" id="inputNumPessoas" value="{{old('num_pessoas',$movimento->num_pessoas)}}"/>
        @if ($errors->has('num_pessoas'))
            <em>{{ $errors->first('num_pessoas') }}</em>
        @endif
    </div>

</div>
