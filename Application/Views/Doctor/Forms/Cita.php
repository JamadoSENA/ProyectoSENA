<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../../../../Configuration/Connection.php");

    $estado = $_POST["Estado"];
    $paciente = $_POST["Paciente"];
    $doctor = $_POST["Doctor"];

    // Convertir las fechas al formato correcto para MySQL
    $inicio = DateTime::createFromFormat('Y-m-d\TH:i', $_POST["Inicio"])->format('Y-m-d H:i:s');
    $fin = DateTime::createFromFormat('Y-m-d\TH:i', $_POST["Fin"])->format('Y-m-d H:i:s');

    // Preparar la consulta
    $insert_scheduling = $conexion->prepare("CALL INSERTARCITA(?, ?, ?, ?, ?)");
    $insert_scheduling->bind_param("ssiii", $estado, $inicio, $fin, $paciente, $doctor);

    // Ejecutar la consulta
    if ($insert_scheduling->execute()) {
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
                     window.location = '../DoctorIndex.php'; // Redirige después de cerrar el Swal
                 });
             </script>
         </body>
         </html>";
    } else {
        // Si ocurre un error, mostrar mensaje con SweetAlert
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al registrar la cita: " . $insert_scheduling->error . "',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    // Cerrar la consulta
    $insert_scheduling->close();
}
?>