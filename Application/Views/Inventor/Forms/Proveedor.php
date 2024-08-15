<?php
// Requerir el archivo de conexión
require '../../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST (para AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $nit = $_POST["NIT"];
    $nombre = $_POST["Nombre"];
    $direccion = $_POST["Direccion"];
    $correo = $_POST["Correo"];
    $telefono = $_POST["Telefono"];

    // Consulta para verificar si el usuario ya existe
    $consulta_proveedor = $conexion->prepare("SELECT idSupplier FROM suppliers WHERE idSupplier = ?");
    $consulta_proveedor->bind_param("i", $nit);
    $consulta_proveedor->execute();
    $resultado = $consulta_proveedor->get_result();

    if ($resultado->num_rows > 0) {
        header("location:ErrorPages/ErrorTwo.php"); // El usuario ya existe
    } else {
        // Preparar la consulta de inserción
        $insertar_proveedor = $conexion->prepare("CALL INSERTARPROVEEDOR(?, ?, ?, ?, ?)");
        $insertar_proveedor->bind_param("issss", $nit, $nombre, $direccion, $correo,
        $telefono);

        // Ejecutar la consulta de inserción
        if ($insertar_proveedor->execute()) {
            header("location:../InventorProveedores.php");
        } else {
            header("location:ErrorPages/ErrorTwoOne.php"); // Error al crear el usuario
        }

        // Cerrar la consulta de inserción
        $insertar_proveedor->close();
    }

    // Cerrar la consulta de verificación de usuario
    $consulta_proveedor->close();
} else {
    // Si los datos del formulario están incompletos o se accede directamente al archivo PHP, puedes manejarlo aquí.
    echo "Error: Acceso inválido.";
}
?>