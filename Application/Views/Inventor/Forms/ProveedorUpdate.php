<?php 

require '../../../../Configuration/Connection.php';

    $nit = $_POST["NIT"];
    $nombre = $_POST["Nombre"];
    $direccion = $_POST["Direccion"];
    $correo = $_POST["Correo"];
    $telefono = $_POST["Telefono"];

    $sql = "UPDATE suppliers SET  nameSU='".$nombre."',
                                    addressSU='".$direccion."',
                                    email='".$correo."',  
                                    phoneNumber='".$telefono."'
                                    WHERE idSupplier = ".$nit."";

    if ($resultado = $conexion->query($sql)) {
        header("location:../InventorProveedores.php");
      }                           
    

?>