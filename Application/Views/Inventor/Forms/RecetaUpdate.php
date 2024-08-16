<?php 

require '../../../../Configuration/Connection.php';

    $id = $_POST["idRecipe"];
    $estado = $_POST["Estado"];

    $sql = "UPDATE recipes SET    stateR='".$estado."'
                                    WHERE idRecipe = ".$id."";

    if ($resultado = $conexion->query($sql)) {
        header("location:../InventorRecetas.php");
      }                           
    

?>