<?php
   
require_once ("Connection.php");

if (isset($_POST['accion'])){ 
    
    switch ($_POST['accion']){

            case 'acceso_user';
            acceso_user();
            break;

		}

	}

function acceso_user() {

    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    session_start();
    $_SESSION['correo']=$correo;

    $conexion=mysqli_connect("localhost","root","","MediStock");
    $consulta= "SELECT * FROM users WHERE email='$correo' AND passwordU='$contrasenia'";
    $resultado=mysqli_query($conexion, $consulta);
    $filas=mysqli_fetch_array($resultado);

    if($filas['fkIdRole'] == 1){ //Paciente

        header('Location: ../Application/Views/Patient/PatientIndex.php');

    }else if($filas['fkIdRole'] == 2){ //Doctor

        header('Location: ../Application/Views/Doctor/DoctorIndex.php');

    }else if($filas['fkIdRole'] == 3){ //Inventor

        header('Location: ../Application/Views/Inventor/InventorIndex.php');

    }else{

        header('Location: ../App/LogIn.php');
        session_destroy();

    }

}






