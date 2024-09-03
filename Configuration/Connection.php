<?php

$host = "citasmedicas.mysql.database.azure.com";
$user = "GAES8";
$password = "juli123*";
$database = "medistock";
$port = 3306;

// Inicializar la conexión
$conexion = mysqli_init();

// Configurar SSL
mysqli_ssl_set($conexion, NULL, NULL, NULL, NULL, NULL);

// Establecer opciones de conexión seguras
mysqli_options($conexion, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

// Conectar a la base de datos
if (!mysqli_real_connect($conexion, $host, $user, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("No se realizó la conexión a la base de datos, el error fue: " . mysqli_connect_error());
}

?>
