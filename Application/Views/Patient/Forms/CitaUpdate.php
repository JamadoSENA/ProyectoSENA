<?php 

require '../../../../Configuration/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['idScheduling'];
    $estado = $_POST['Estado'];
    $paciente = $_POST['idPatient'];

    // Usar consultas preparadas para evitar problemas de SQL Injection
    $stmt = $conexion->prepare("
        UPDATE schedulings 
        SET stateS = ?, fkIdPatient = ?
        WHERE idScheduling = ?
    ");
    $stmt->bind_param("sii", $estado, $paciente, $id);

    if ($stmt->execute()) {
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
                     window.location = '../PatientMyCitas.php'; // Redirige después de cerrar el Swal
                 });
             </script>
         </body>
         </html>";
        exit();
    } else {
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
                     icon: 'success'
                 }).then(function() {
                     window.location = '../PatientCitas.php'; // Redirige después de cerrar el Swal
                 });
             </script>
         </body>
         </html>";
    }
    
    $stmt->close();
    $conexion->close();
} else {
    // Si no se está enviando el formulario, redirigir o manejar el error
    header("Location: ../PatientIndex.php");
    exit();
}
?>