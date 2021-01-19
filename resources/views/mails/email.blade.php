<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Envío de Constraseña</title>
</head>
<body>
    <h1>Solicitud de Documento de Identificación Personal</h1>
    <p>La solicitud se encuentra en proceso con los siguientes datos:</p>
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
    <p>La contraseña es: <strong>{{ $password }}</strong></p>
    <p>
        Para visualizar el estado de su solicitud puede iniciar sesión con el correo registrado y la contraseña en la 
        <a href="https://drive.google.com/file/d/1GkRyztYYGAwnr87xZZam0W95B_ikLhZk/view" download>aplicación</a>
        .
    </p>
</body>
</html>