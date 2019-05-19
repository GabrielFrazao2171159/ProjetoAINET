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
        <label for="inputAeronave">Aeronave</label>
        <input
                type="text" class="form-control"
                name="aeronave" id="inputAeronave" value="{{old('aeronave',$movimento->aeronave)}}"/>
        @if ($errors->has('aeronave'))
            <em>{{ $errors->first('aeronave') }}</em>
        @endif
    </div>
</div>
