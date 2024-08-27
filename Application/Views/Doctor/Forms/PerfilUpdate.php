<?php 

require '../../../../Configuration/Connection.php';

    $id = $_POST['idUser'];
    $correo = $_POST['Email'];
    $telefono = $_POST['NumeroTelefono'];
    $profesion = $_POST['Profesion'];
    $direccion = $_POST['Direccion'];

    $sql = "UPDATE users SET email='".$correo."',
                                  phoneNumber='".$telefono."',
                                  profession='".$profesion."',  
                                  addressU='".$direccion."'
                                  WHERE idUser = ".$id."";

    if ($resultado = $conexion->query($sql)) {
        header("location:../DoctorCitas.php");
      }                           
    

?>