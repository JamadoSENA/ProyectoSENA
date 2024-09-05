<?php

session_start();
session_destroy();
header("Content-Type: text/html; charset=UTF-8");

            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Sesion Cerrada</title>
                <link rel='shortcut icon' href='../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'La sesion ha sido cerrada correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = '../LogIn.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";

?>