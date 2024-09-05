<?php
// Requerir el archivo de conexión
require 'Connection.php';

// Verificar si la conexión es válida
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

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
    
    if (!$consulta_usuario) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $consulta_usuario->bind_param("iss", $cedula, $telefono, $correo);
    $consulta_usuario->execute();
    $resultado = $consulta_usuario->get_result();

    if ($resultado->num_rows > 0) {
        header("location: ../ErrorPages/ErrorOne.php"); // El usuario ya existe
        exit();
    } else {
        // Preparar la consulta de inserción
        $insert_usuario = $conexion->prepare("CALL INSERTARUSUARIO(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if (!$insert_usuario) {
            die("Error al preparar la consulta de inserción: " . $conexion->error);
        }

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
                <link rel='shortcut icon' href='../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'La información se guardó correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = '../LogIn.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
            exit();
        } else {
            header("location: ../ErrorPages/ErrorZero.php"); // Error al crear el usuario
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
