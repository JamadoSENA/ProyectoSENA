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
        echo "<script>
                Swal.fire({
                    title: '¡Buen trabajo!',
                    text: 'La información se actualizó correctamente.',
                    icon: 'success'
                }).then(function() {
                    window.location = '../PatientIndex.php'; // Redirige después de cerrar el Swal
                });
        </script>";
        exit();
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al actualizar la información: " . $stmt->error . "',
                    icon: 'error'
                });
        </script>";
    }
    
    $stmt->close();
    $conexion->close();
} else {
    // Si no se está enviando el formulario, redirigir o manejar el error
    header("Location: ../PatientIndex.php");
    exit();
}
?>
