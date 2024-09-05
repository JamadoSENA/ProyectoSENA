<?php
// Inicializa la conexión
$con = mysqli_init();

// Establece el path del certificado, la clave y el certificado CA (si los tienes)
mysqli_ssl_set($con, NULL, NULL, "mysql-cert.cert", NULL, NULL);

// Realiza la conexión a la base de datos con SSL habilitado
if (!mysqli_real_connect($con, "citasmedicas.mysql.database.azure.com", "GAES8", "juli123*", "medistock", 3306, NULL, MYSQLI_CLIENT_SSL)) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa usando SSL";
}
?>

?>
