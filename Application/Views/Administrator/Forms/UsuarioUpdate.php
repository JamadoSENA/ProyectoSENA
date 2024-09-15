<?php 
// Conectar a la base de datos
require("../../../Configuration/Connection.php");

// Obtener los datos del formulario
$idUser = $_POST['idUser'];
$documentType = htmlspecialchars($_POST['documentType']);
$nameU = htmlspecialchars($_POST['nameU']);
$lastname = htmlspecialchars($_POST['lastname']);
$birthdate = $_POST['birthdate'];
$age = $_POST['age'];
$gender = htmlspecialchars($_POST['gender']);
$role = $_POST['role'];

// Preparar y ejecutar la consulta de actualización
$sql_update = "UPDATE users SET 
                documentType = '$documentType',
                nameU = '$nameU',
                lastname = '$lastname',
                birthdate = '$birthdate',
                age = '$age',
                gender = '$gender',
                fkIdRole = '$role'
                WHERE idUser = $idUser";

if ($conexion->query($sql_update) === TRUE) {
    // Enviar encabezado de tipo de contenido como HTML
    header("Content-Type: text/html; charset=UTF-8");

    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Cambio Exitoso</title>
        <link rel='shortcut icon' href='../../../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
        <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
    </head>
    <body>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
        <script>
            Swal.fire({
                title: '¡Excelente!',
                text: 'La información se actualizo correctamente.',
                icon: 'success'
            }).then(function() {
                window.location = '../AdministratorUsuarios.php'; // Redirige después de cerrar el Swal
            });
        </script>
    </body>
    </html>";
   exit();
} else {
    // Manejo de errores
    echo "Error: " . $sql_update . "<br>" . $conexion->error;
}

// Cerrar la conexión
$conexion->close();

?>