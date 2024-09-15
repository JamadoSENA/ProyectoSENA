<?php
require("../../../Configuration/Connection.php");

if (isset($_POST['idRole']) && isset($_POST['roleName'])) {
    $idRole = $_POST['idRole'];
    $roleName = $_POST['roleName'];

    // Actualizar el nombre del rol en la base de datos
    $sql = $conexion->prepare("UPDATE roles SET name = ? WHERE idRole = ?");
    $sql->bind_param("si", $roleName, $idRole);

    if ($sql->execute()) {
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
                    window.location = '../AdministratorRoles.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";
       exit();
    } else {
        // Enviar encabezado de tipo de contenido como HTML
        header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Cambio Fallido</title>
            <link rel='shortcut icon' href='../../../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'La información no se actualizo correctamente.',
                    icon: 'error'
                }).then(function() {
                    window.location = '../AdministratorRoles.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";
       exit();
    }

    $sql->close();
}
?>
