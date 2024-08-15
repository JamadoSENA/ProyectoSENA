<?php
// Requerir el archivo de conexión
require '../../../../Configuration/Connection.php';

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

    $insert_medicine = $conexion->prepare("CALL INSERTARMEDICINA(?, ?, ?, ?, ?, ?, ?)");
    $insert_medicine->bind_param("ssssdsi", $nombre, $formato, 
    $cantidad, $estado, $fechaVencimiento, $categoria, $proveedor);

        // Ejecutar la consulta de inserción
        if ($insert_medicine->execute()) {
            header("location:../InventorMedicinas.php");
        } 
        // Cerrar la consulta de inserción
        $insert_medicine->close();

} 

?>