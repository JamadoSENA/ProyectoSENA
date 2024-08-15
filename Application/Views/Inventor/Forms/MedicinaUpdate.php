<?php 

require '../../../../Configuration/Connection.php';

    $id = $_POST["idMedicine"];
    $cantidad = $_POST["Cantidad"];
    $estado = $_POST["Estado"];

    $sql = "UPDATE medicines SET  stock='".$cantidad."',
                                    stateM='".$estado."'
                                    WHERE idMedicine = ".$id."";

    if ($resultado = $conexion->query($sql)) {
        header("location:../InventorMedicinas.php");
      }                           
    

?>