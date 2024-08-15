<?php 

require '../../../../Configuration/Connection.php';

    $id = $_POST['idScheduling'];
    $estado = $_POST['Estado'];
    $inicio = $_POST['Inicio'];
    $fin = $_POST['Fin'];
    $paciente = $_POST['Paciente'];
    $doctor = $_POST['Doctor'];

    $sql = "UPDATE schedulings SET stateS='".$estado."',
                                  dateHourStart='".$inicio."',
                                  dateHourEnd='".$fin."',  
                                  fkIdPatient='".$paciente."',
                                  fkIdDoctor='".$doctor."'
                                  WHERE idScheduling = ".$id."";

    if ($resultado = $conexion->query($sql)) {
        header("location:../DoctorCitas.php");
      }                           
    

?>