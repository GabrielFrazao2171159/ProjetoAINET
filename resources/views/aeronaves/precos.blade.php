<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    @foreach($valores as $valor)
        @unset($valor->id)
        @unset($valor->matricula)
        @json($valor)
        <br>
    @endforeach
</body>
</html>