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