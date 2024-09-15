<?php 
session_start();
error_reporting(0);

// Verificar si el usuario está autenticado
$validar = $_SESSION['correo'];

if ($validar == null || $validar == '') {
    header("Location: ../../LogIn.php");
    die();
} 

// Obtener el nombre del usuario desde la base de datos
require("../../Configuration/Connection.php");

// Obtener el idUser del usuario actual
$sql_user = $conexion->query("SELECT idUser FROM users WHERE email = '$validar'");
$user_data = $sql_user->fetch_assoc();
$user_id = $user_data['idUser'];

// Obtener el nombre del usuario
$sql_name = $conexion->query("SELECT * FROM users WHERE idUser = $user_id");
$user_info = $sql_name->fetch_assoc();
$user_name = $user_info['nameU'];
$user_lastname = $user_info['lastname'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <hr>
                    <img src="../../Resources/IMG/LogoSidebarMediStock.png" alt="MediStock" width="auto" height="75" />
                    </a>
                    <br>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li alt="Inicio">
                            <a href="AdministratorIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill" alt="Inicio"></i> <span
                                    class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li alt="Usuarios">
                            <a href="AdministratorUsuarios.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-people-fill" alt="Usuarios"></i> <span class="ms-1 d-none d-sm-inline">
                                    Usuarios</span> </a>
                        </li>
                        <li alt="Mis Citas">
                            <a href="AdministratorRoles.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-person-fill-gear" alt="Roles"></i> <span
                                    class="ms-1 d-none d-sm-inline">Roles</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="mt-auto dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-person" alt="hugenerd" width="30" height="30"></i>
                            <span
                                class="d-none d-sm-inline mx-1"><?php echo $user_name . ' ' . $user_lastname; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="Profile/Index.php">Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../Configuration/SignOut.php">Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <div class="card text-center">
                    <div class="card-header">
                        ¡Bienvenido/a <?php echo $user_name . ' ' . $user_lastname; ?>!
                    </div>
                    <div class="card-body">
                        <div class="container text-space-center">
                            <div class="row align-items-stretch">
                                <div class="row justify-content-center mb-2">
                                    <div class="col-12 col-md-6 text-center">
                                        <p>Medicamentos próximos a vencer</p>
                                        <canvas id="medicinasVencidas" style="width: 100%; height: 300px;"></canvas>
                                    </div>
                                    <div class="col-12 col-md-6 text-center">
                                        <p>Medicamentos prontos a terminarse</p>
                                        <canvas id="medicinasStock" style="width: 100%; height: 300px;"></canvas>
                                    </div>
                                    <hr>
                                    <div class="col-12 col-md-6 text-center">
                                        <p>Estados de citas</p>
                                        <canvas id="citasPendientes" style="width: 100%; height: 300px;"></canvas>
                                    </div>
                                    <div class="col-12 col-md-6 text-center">
                                        <p>Estados de recetas</p>
                                        <canvas id="retiroRecetas" style="width: 100%; height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <?php 
        // Consulta para obtener los 5 medicamentos con menor cantidad de stock
        $sql_medicinas_stock = "
        SELECT 
            nameM, stock
        FROM 
            medicines
        ORDER BY 
            stock ASC
        LIMIT 5
        ";

        $result_medicinas_stock = $conexion->query($sql_medicinas_stock);

        $medicinas_nombres = [];
        $medicinas_stock = [];
        while($row = $result_medicinas_stock->fetch_assoc()) {
            $medicinas_nombres[] = $row['nameM'];
            $medicinas_stock[] = $row['stock'];
        }

        // Consulta para obtener los medicamentos según su fecha de vencimiento, aplicando semaforización
        $sql_medicinas_vencimiento = "
        SELECT 
            nameM, 
            DATEDIFF(expirationDate, CURDATE()) as dias_restantes
        FROM 
            medicines
        ";

        $result_medicinas_vencimiento = $conexion->query($sql_medicinas_vencimiento);

        $medicinas_vencimiento = [
            'rojo' => 0,    // Menos de 6 meses (menos de 180 días)
            'amarillo' => 0, // Entre 6 y 12 meses (entre 180 y 365 días)
            'verde' => 0    // Más de 12 meses (más de 365 días)
        ];

        while($row = $result_medicinas_vencimiento->fetch_assoc()) {
            if ($row['dias_restantes'] < 180) {
                $medicinas_vencimiento['rojo']++;
            } elseif ($row['dias_restantes'] <= 365) {
                $medicinas_vencimiento['amarillo']++;
            } else {
                $medicinas_vencimiento['verde']++;
            }
        }

        ?>

    <?php 
    

    // Obtener las citas por estado (Reservada y No Reservada)
    $sql_citas_por_estado = "
    SELECT 
        SUM(CASE WHEN stateS = 'Reservada' THEN 1 ELSE 0 END) AS reservada,
        SUM(CASE WHEN stateS = 'No Reservada' THEN 1 ELSE 0 END) AS no_reservada
    FROM schedulings
    ";

    $result_citas_por_estado = $conexion->query($sql_citas_por_estado);
    $citas_por_estado = $result_citas_por_estado->fetch_assoc();
    $reservada = $citas_por_estado['reservada'];
    $no_reservada = $citas_por_estado['no_reservada'];

    // Obtener las recetas por estado (Retirado y No Retirado)
    $sql_recetas_por_estado = "
        SELECT 
            SUM(CASE WHEN stateR = 'Retirado' THEN 1 ELSE 0 END) AS retirado,
            SUM(CASE WHEN stateR = 'No Retirado' THEN 1 ELSE 0 END) AS no_retirado
        FROM recipes
    ";

    $result_recetas_por_estado = $conexion->query($sql_recetas_por_estado);
    $recetas_por_estado = $result_recetas_por_estado->fetch_assoc();
    $retirado = $recetas_por_estado['retirado'];
    $no_retirado = $recetas_por_estado['no_retirado'];
    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const ctxStock = document.getElementById('medicinasStock');
    const ctxVencidas = document.getElementById('medicinasVencidas');

    // Datos de las medicinas según el stock y nombres de medicamentos
    const dataMedicinasStock = <?php echo json_encode($medicinas_stock); ?>;
    const labelsMedicinasStock = <?php echo json_encode($medicinas_nombres); ?>;

    // Datos de semaforización de las medicinas por vencimiento
    const dataMedicinasVencimiento = {
        rojo: <?php echo $medicinas_vencimiento['rojo']; ?>,
        amarillo: <?php echo $medicinas_vencimiento['amarillo']; ?>,
        verde: <?php echo $medicinas_vencimiento['verde']; ?>
    };

    // Gráfico para medicinas según el stock (10 medicamentos con menor stock)
    new Chart(ctxStock, {
        type: 'bar',
        data: {
            labels: labelsMedicinasStock,
            datasets: [{
                label: '# de Medicinas por Stock',
                data: dataMedicinasStock,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico para medicinas a vencer con semaforización
    new Chart(ctxVencidas, {
        type: 'bar',
        data: {
            labels: ['Menos de 6 meses', '6 a 12 meses', 'Más de 12 meses'],
            datasets: [{
                label: '# de Medicinas por Semaforización',
                data: [dataMedicinasVencimiento.rojo, dataMedicinasVencimiento.amarillo,
                    dataMedicinasVencimiento.verde
                ],
                backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(255, 206, 86, 0.5)',
                    'rgba(82,219,53,0.5)'
                ],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)',
                    'rgba(82,219,53,1)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    // Datos de citas por estado (Reservada y No Reservada)
    const ctxCitasPendientes = document.getElementById('citasPendientes').getContext('2d');
    new Chart(ctxCitasPendientes, {
        type: 'bar',
        data: {
            labels: ['Reservada', 'No Reservada'],
            datasets: [{
                label: 'Número de Citas',
                data: [<?php echo $reservada; ?>, <?php echo $no_reservada; ?>],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)', // Color para Reservada
                    'rgba(255, 99, 132, 0.5)' // Color para No Reservada
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)', // Borde para Reservada
                    'rgba(255, 99, 132, 1)' // Borde para No Reservada
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Datos de recetas por estado (Retirado y No Retirado)
    const ctxRecetas = document.getElementById('retiroRecetas').getContext('2d');
    new Chart(ctxRecetas, {
        type: 'bar',
        data: {
            labels: ['Retirado', 'No Retirado'],
            datasets: [{
                label: 'Número de Recetas',
                data: [<?php echo $retirado; ?>, <?php echo $no_retirado; ?>],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)', // Color para Retirado
                    'rgba(255, 159, 64, 0.5)' // Color para No Retirado
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)', // Borde para Retirado
                    'rgba(255, 159, 64, 1)' // Borde para No Retirado
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>

</html>