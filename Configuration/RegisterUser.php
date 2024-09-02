<?php
// Requerir el archivo de conexión
require 'Connection.php';

// Verificar si se ha enviado una solicitud POST (para AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $cedula = $_POST["Cedula"];
    $tipoDocumento = $_POST["TipoDocumento"];
    $nombre = $_POST["Nombre"];
    $apellido = $_POST["Apellido"];
    $fechaNacimiento = $_POST["FechaNacimiento"];
    $edad = $_POST["Edad"];
    $genero = $_POST["Genero"];
    $telefono = $_POST["Telefono"];
    $profesion = $_POST["Profesion"];
    $direccion = $_POST["Direccion"];    
    $correo = $_POST["Correo"];
    $contrasenia = $_POST["Contrasenia"];
    $rol = $_POST["Rol"];

    // Consulta para verificar si la cédula, número de teléfono o correo ya existen
    $consulta_usuario = $conexion->prepare("SELECT idUser FROM users WHERE idUser = ? OR phoneNumber = ? OR email = ?");
    $consulta_usuario->bind_param("iss", $cedula, $telefono, $correo);
    $consulta_usuario->execute();
    $resultado = $consulta_usuario->get_result();

    if ($resultado->num_rows > 0) {
        header("location:../Application/ErrorPages/ErrorOne.php"); // El usuario ya existe
        exit();
    } else {
        // Preparar la consulta de inserción
        $insert_usuario = $conexion->prepare("CALL INSERTARUSUARIO(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_usuario->bind_param("isssssssssssi", $cedula, $tipoDocumento, $nombre, $apellido,
        $fechaNacimiento, $edad, $genero, $telefono, $profesion, $direccion, 
        $correo, $contrasenia, $rol);

        // Ejecutar la consulta de inserción
        if ($insert_usuario->execute()) {
            // Enviar encabezado de tipo de contenido como HTML
            header("Content-Type: text/html; charset=UTF-8");

            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Registro Exitoso</title>
                <link rel='shortcut icon' href='../Application/Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'La información se guardo correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = '../Application/LogIn.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
            exit();
        } else {
            header("location: ../Application/ErrorPages/ErrorZero.php"); // Error al crear el usuario
            exit();
        }

        // Cerrar la consulta de inserción
        $insert_usuario->close();
    }

    // Cerrar la consulta de verificación de usuario
    $consulta_usuario->close();
} else {
    // Si los datos del formulario están incompletos o se accede directamente al archivo PHP, puedes manejarlo aquí.
    echo "Error: Acceso inválido.";
}
?>
