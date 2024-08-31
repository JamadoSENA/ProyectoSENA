<?php
require '../Configuration/Connection.php'; // Archivo para conectar con la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $codigoIngresado = $_POST['codigo'];
    $nuevaContraseña = $_POST['contrasenia'];

    // Verificar el código ingresado
    $stmt = $conexion->prepare("SELECT code FROM users WHERE email = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($codigoRecuperacion);
    $stmt->fetch();
    $stmt->close();

    if ($codigoIngresado === $codigoRecuperacion) {
        // Cifrar la nueva contraseña
        $contraseñaCifrada = password_hash($nuevaContraseña, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $stmt = $conexion->prepare("UPDATE users SET passwordU = ?, code = NULL WHERE email = ?");
        $stmt->bind_param("ss", $contraseñaCifrada, $correo);
        if ($stmt->execute()) {
            header("Content-Type: text/html; charset=UTF-8");

            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Cambio Exitoso</title>
                <link rel='shortcut icon' href='Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'Se ha cambiado la contraseña correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = 'LogIn.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
        } else {
            header("Content-Type: text/html; charset=UTF-8");

            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Cambio Fallido</title>
                <link rel='shortcut icon' href='Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Error!',
                        text: 'No se ha cambiado la contraseña correctamente.',
                        icon: 'error'
                    }).then(function() {
                        window.location = 'LogInPassword.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
        }
        $stmt->close();
    } else {
        header("Content-Type: text/html; charset=UTF-8");

            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Codigo Incorrecto</title>
                <link rel='shortcut icon' href='Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Error!',
                        text: 'El codigo de verificacion es incorrecto.',
                        icon: 'error'
                    }).then(function() {
                        window.location = 'LogInPassword.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
    }
}
?>