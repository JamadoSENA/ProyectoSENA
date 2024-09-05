<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:medistockapp.database.windows.net,1433; Database = citasmedicas", "gaes8", "juli123*");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "gaes8", "pwd" => "juli123*", "Database" => "citasmedicas", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:medistockapp.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>