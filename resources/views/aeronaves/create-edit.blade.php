<div class="form-group">
    <label for="inputMatricula">Matricula</label>
    <input
        type="text" class="form-control"
        name="matricula" id="inputMatricula" value="{{old('matricula',$aeronave->matricula)}}"/>
    @if ($errors->has('matricula'))
        <em>{{ $errors->first('matricula') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputMarca">Marca</label>
    <input
        type="text" class="form-control"
        name="marca" id="inputMarca" value="{{old('marca',$aeronave->marca)}}"/>
    @if ($errors->has('marca'))
        <em>{{ $errors->first('marca') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputModelo">Modelo</label>
    <input
        type="text" class="form-control"
        name="modelo" id="inputModelo" value="{{old('modelo',$aeronave->modelo)}}"/>
    @if ($errors->has('modelo'))
        <em>{{ $errors->first('modelo') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputLugares">Número de Lugares</label>
    <input
        type="text" class="form-control"
        name="num_lugares" id="inputLugares" value="{{old('num_lugares',$aeronave->num_lugares)}}"/>
    @if ($errors->has('num_lugares'))
        <em>{{ $errors->first('num_lugares') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputHoras">Horas</label>
    <input
        type="text" class="form-control"
        name="conta_horas" id="inputHoras" value="{{old('conta_horas',$aeronave->conta_horas)}}"/>
    @if ($errors->has('conta_horas'))
        <em>{{ $errors->first('conta_horas') }}</em>
    @endif 
</div>
<div class="form-group">
    <label for="inputPrecoHora">Preço por Hora</label>
    <input
        type="text" class="form-control"
        name="preco_hora" id="inputPrecoHora" value="{{old('preco_hora',$aeronave->preco_hora)}}"/>
    @if ($errors->has('preco_hora'))
        <em>{{ $errors->first('preco_hora') }}</em>
    @endif 
</div>