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
                  text: 'La información se actualizo correctamente.',
                  icon: 'success'
              }).then(function() {
                  window.location = '../InventorProveedores.php'; // Redirige después de cerrar el Swal
              });
          </script>
      </body>
      </html>";
          exit();
      }                           
    

?>