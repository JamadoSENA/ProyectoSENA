<?php

require_once ("Connection.php");

if (isset($_POST['accion'])){ 
    
    switch ($_POST['accion']){

            case 'acceso_user';
            acceso_user();
            break;

		}

	}

function acceso_user() {

    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    session_start();
    $_SESSION['correo']=$correo;

    $conexion=mysqli_connect("localhost","root","","MediStock");
    $consulta= "SELECT * FROM users WHERE email='$correo' AND passwordU='$contrasenia'";
    $resultado=mysqli_query($conexion, $consulta);
    $filas=mysqli_fetch_array($resultado);

    if($filas['fkIdRole'] == 1){ //Paciente

        // Enviar encabezado de tipo de contenido como HTML
        header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Inicio de Sesion</title>
            <link rel='shortcut icon' href='../Application/Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Has iniciado sesion correctamente.',
                    icon: 'success'
                }).then(function() {
                    window.location = '../Application/Views/Patient/PatientIndex.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";

    }else if($filas['fkIdRole'] == 2){ //Doctor

        // Enviar encabezado de tipo de contenido como HTML
        header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Inicio de Sesion</title>
            <link rel='shortcut icon' href='../Application/Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Has iniciado sesion correctamente.',
                    icon: 'success'
                }).then(function() {
                    window.location = '../Application/Views/Doctor/DoctorIndex.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";


    }else if($filas['fkIdRole'] == 3){ //Inventor

        // Enviar encabezado de tipo de contenido como HTML
        header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Inicio de Sesion</title>
            <link rel='shortcut icon' href='../Application/Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Has iniciado sesion correctamente.',
                    icon: 'success'
                }).then(function() {
                    window.location = '../Application/Views/Inventor/InventorIndex.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";


    }else{

        header('Location: ../App/LogIn.php');
        session_destroy();

    }

}






