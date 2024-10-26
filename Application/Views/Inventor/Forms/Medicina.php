<?php
// Requerir el archivo de conexión
require '../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST (para AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $nombre = $_POST["Nombre"];
    $formato = $_POST["Formato"];
    $cantidad = $_POST["Cantidad"];
    $estado = $_POST["Estado"];
    $fechaVencimiento = $_POST["FechaVencimiento"];
    $categoria = $_POST["Categoria"];
    $proveedor = $_POST["Proveedor"];

    // Verificar si el nombre de la medicina ya existe
    $check_name = $conexion->prepare("SELECT COUNT(*) FROM medicines WHERE nameM = ?");
    $check_name->bind_param("s", $nombre);
    $check_name->execute();
    $check_name->bind_result($count);
    $check_name->fetch();
    $check_name->close();

    if ($count > 0) {
        // El nombre ya existe, mostrar alerta y detener el proceso
        header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Error de Registro</title>
            <link rel='shortcut icon' href='../../../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: 'Error',
                    text: 'El nombre de la medicina ya está registrado.',
                    icon: 'error'
                }).then(function() {
                    window.location = '../InventorMedicinas.php'; // Regresar a la página anterior
                });
            </script>
        </body>
        </html>";
        exit();
    }

    // Preparar y ejecutar la consulta de inserción
    $insert_medicine = $conexion->prepare("CALL INSERTARMEDICINA(?, ?, ?, ?, ?, ?, ?)");
    $insert_medicine->bind_param("ssssdsi", $nombre, $formato, $cantidad, $estado, $fechaVencimiento, $categoria, $proveedor);

    // Ejecutar la consulta de inserción
    if ($insert_medicine->execute()) {
        header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registro Exitoso</title>
            <link rel='shortcut icon' href='../../../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'La información se registró correctamente.',
                    icon: 'success'
                }).then(function() {
                    window.location = '../InventorMedicinas.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";
        exit();
    } 

    // Cerrar la consulta de inserción
    $insert_medicine->close();
}
?>
