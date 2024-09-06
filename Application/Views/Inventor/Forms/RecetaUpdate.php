<?php 

require '../../../Configuration/Connection.php';

$id = $_POST["idRecipe"];
$estado = $_POST["Estado"];
$cantidad = $_POST["Cantidad"];
$medicamento = $_POST["Medicamento"];

// Inicia una transacción
$conexion->begin_transaction();

try {
    // Obtener la cantidad actual y el id del medicamento
    $sqlSelectMedicine = "SELECT fkIdMedicine, amount FROM recipes WHERE idRecipe = ?";
    $stmt = $conexion->prepare($sqlSelectMedicine);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($fkIdMedicine, $oldAmount);
    $stmt->fetch();
    $stmt->close();

    // Actualizar la tabla recipes
    $sqlUpdateRecipe = "UPDATE recipes 
                        SET stateR = ?, 
                            amount = ? 
                        WHERE idRecipe = ?";
    $stmt = $conexion->prepare($sqlUpdateRecipe);
    $stmt->bind_param("sii", $estado, $cantidad, $id);
    $stmt->execute();
    
    if ($stmt->affected_rows === 0) {
        throw new Exception("No se actualizó ninguna receta.");
    }

    // Actualizar el stock del medicamento en la tabla medicines
    $sqlUpdateMedicine = "UPDATE medicines 
                          SET stock = stock + ? - ? 
                          WHERE idMedicine = ?";
    $stmt = $conexion->prepare($sqlUpdateMedicine);
    $stmt->bind_param("iii", $cantidad, $oldAmount, $fkIdMedicine);
    $stmt->execute();

    // Confirma la transacción
    $conexion->commit();

    // Muestra el mensaje de éxito
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
                text: 'La información se actualizó correctamente.',
                icon: 'success'
            }).then(function() {
                window.location = '../InventorRecetas.php'; // Redirige después de cerrar el Swal
            });
        </script>
    </body>
    </html>";
    exit();

} catch (Exception $e) {
    // Si ocurre un error, deshace la transacción
    $conexion->rollback();
    echo "Error: " . $e->getMessage();
}

?>
