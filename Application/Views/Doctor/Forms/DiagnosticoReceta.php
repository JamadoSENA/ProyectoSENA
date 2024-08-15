<?php
// Requerir el archivo de conexión
require '../../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $viaAdmin = $_POST["viaAdministracion"];
    $dias = $_POST["dias"];
    $meses = $_POST["meses"];
    $horas = $_POST["horas"];
    $cantidades = $_POST["cantidades"];
    $estado =  $_POST["estado"];
    $instrucciones = $_POST["instrucciones"];
    $medicamento = $_POST["fkIdMedicine"];
    $diagnostico = $_POST["fkIdDiagnosis"];

    $insert_recipe = $conexion->prepare("CALL INSERTARRECETA(?, ?, ?, ?, ?, ?, ?)");
    $insert_recipe->bind_param("ssssissii", $viaAdmin, $dias, $meses, $horas, $cantidades,
    $estado, $instrucciones, $medicamento, $diagnostico);

        // Ejecutar la consulta de inserción
        if ($insert_recipe->execute()) {
            header("location:../DoctorRecetas.php");
        } 
        // Cerrar la consulta de inserción
        $insert_recipe->close();

} 

?>