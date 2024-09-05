<?php

require_once("Connection.php");

if (isset($_POST['accion'])) { 
    
    switch ($_POST['accion']) {
        case 'acceso_user';
        acceso_user();
        break;
    }
}

function acceso_user() {
    $conexion; // Utiliza la conexión global establecida en Connection.php

    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    session_start();
    $_SESSION['correo'] = $correo;

    // Consulta para verificar el correo y la contraseña
    $consulta = "SELECT * FROM users WHERE email = ? AND passwordU = ?";
    $stmt = $conexion->prepare($consulta);

    if (!$stmt) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("ss", $correo, $contrasenia);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $filas = $resultado->fetch_assoc();

    if ($filas) {
        if ($filas['fkIdRole'] == 1) { // Paciente
            header("Content-Type: text/html; charset=UTF-8");
            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Inicio de Sesión</title>
                <link rel='shortcut icon' Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'Has iniciado sesión correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = '../Views/Patient/PatientIndex.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
        } elseif ($filas['fkIdRole'] == 2) { // Doctor
            header("Content-Type: text/html; charset=UTF-8");
            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Inicio de Sesión</title>
                <link rel='shortcut icon' href='../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'Has iniciado sesión correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = '../Views/Doctor/DoctorIndex.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
        } elseif ($filas['fkIdRole'] == 3) { // Inventor
            header("Content-Type: text/html; charset=UTF-8");
            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Inicio de Sesión</title>
                <link rel='shortcut icon' href='../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'Has iniciado sesión correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = '../Views/Inventor/InventorIndex.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
        } else {
            header('Location: ../LogIn.php');
            session_destroy();
        }
    } else {
        header("Content-Type: text/html; charset=UTF-8");
            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Inicio de Sesion Fallido</title>
                <link rel='shortcut icon' href='../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Error!',
                        text: 'El correo o la contraseña son incorrectos.',
                        icon: 'error'
                    }).then(function() {
                        window.location = '../LogIn.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
        session_destroy();
    }

    $stmt->close();
}
?>
