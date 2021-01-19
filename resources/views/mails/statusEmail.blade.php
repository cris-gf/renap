<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Estado de Solicitud de DPI</title>
</head>
<body>
    <h1>Estado de Solicitud de Documento de Identificación Personal</h1>
    <p>El Documento de Identificación Personal con los siguientes datos:</p>
    <ul>
        <li>CUI: {{ $cui }}</li>
        @if (!is_null($identification_card))
            <li>Cédula: {{ $identification_card }}</li>
        @endif
        <li>Nombre: {{ $name }}</li>
        <li>Apellidos: {{ $last_name }}</li>
        <li>Fecha de Nacimiento: {{ $birthdate }}</li>
        <li>Dirección: {{ $address }}</li>
        <li>Teléfono: {{ $phone }}</li>
        <li>Departamento: {{ $department }}</li>
        <li>Municipio: {{ $township }}</li>
    </ul>
    <p>Se encuentra listo para entregar.</p>
</body>
</html>