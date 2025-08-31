<!DOCTYPE html>
<html>
<head>
    <title>Receta PDF</title>
</head>
<body>
    <h1>Recetas</h1>

    @foreach ($mi_receta as $receta)
        <p>Establecimiento: <strong>{{ $receta->fecha }}</strong></p>
        <p>Establecimiento: <strong>{{ $receta->establecimiento->name }}</strong></p>
        <p>Medico Encargado: <strong>{{ $receta->medico->name }}</strong></p>
        <p>Nombre del paciente: <strong>{{ $receta->paciente->name }}</strong></p>
        <p>Edad: <strong>{{ $receta->paciente->age }}</strong></p>
        <p>N° de Receta: <strong>{{ $receta->id }}</strong></p>
    @endforeach


    <table>
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Medicamento</th>
                <th>Dosis</th>
                <th>Indicaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mi_receta as $receta)
            <tr>
                <td>cantidad</td>
                <td>{{ $receta->medicamentos }}</td>
                <td>dosis</td>
                <td>indicaciones</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!--

<h1>Receta Médica</h1>
    {{--@foreach($mi_receta as $receta)
        <p>Establecimiento: <strong>{{ $receta->establecimiento->name }}</strong></p>
        <p>Medico Encargado: <strong>{{ $receta->medico->name }}</strong></p>
        <p>Nombre del paciente: <strong>{{ $receta->paciente->name }}</strong></p>
        <p>Edad: <strong>{{ $receta->paciente->age }}</strong></p>
        <p>N° de Receta: <strong>{{ $receta->id }}</strong></p>
    @endforeach--}}


-->
