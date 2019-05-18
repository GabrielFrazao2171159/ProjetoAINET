<div>
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
