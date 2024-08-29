<?php 

require '../../../../Configuration/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['idUser'];
    $correo = $_POST['Email'];
    $telefono = $_POST['NumeroTelefono'];
    $profesion = $_POST['Profesion'];
    $direccion = $_POST['Direccion'];

    // Usar consultas preparadas para evitar problemas de SQL Injection
    $stmt = $conexion->prepare("
        UPDATE users 
        SET email = ?, phoneNumber = ?, profession = ?, addressU = ?
        WHERE idUser = ?
    ");
    $stmt->bind_param("ssssi", $correo, $telefono, $profesion, $direccion, $id);

    if ($stmt->execute()) {
        header("Location: ../PatientIndex.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conexion->close();
} else {
    // Si no se está enviando el formulario, redirigir o manejar el error
    header("Location: ../PatientIndex.php");
    exit();
}
?>