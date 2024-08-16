<?php 

require '../../../../Configuration/Connection.php';

    $id = $_POST['idScheduling'];
    $estado = $_POST['Estado'];

    $sql = "UPDATE schedulings SET stateS='".$estado."'
                                    WHERE idScheduling = ".$id."";

    if ($resultado = $conexion->query($sql)) {
        header("location:../PatientCitas.php");
    }                           
    

?>