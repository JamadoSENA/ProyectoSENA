<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <script src="Public/Resources/JS/ColorModes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medistock</title>
    <link rel="shortcut icon" href="Public/Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="Public/Resources/CSS/Index.css" rel="stylesheet">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
    }

    /* Mejora en espaciado */
    .section-spacing {
        margin-top: 30px;
    }

    .text-justify {
        text-align: justify;
    }

    /* Espaciado entre íconos y texto */
    .icon-spacing {
        margin-right: 10px;
    }
    </style>

    <link href="Public/Resources/CSS/Cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <!-- Encabezado -->
        <header class="mb-auto">
            <div>
                <img src="Application/Resources/IMG/LogoSidebarMediStock.png" class="float-md-start mb-0"
                    alt="MediStock" width="auto" height="75" />
                <nav class="nav nav-masthead justify-content-center float-md-end" style="margin-top: 20px;">
                    <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="Application/LogIn.php">Iniciar
                        Sesión</a>
                    <a class="nav-link fw-bold py-1 px-0" href="Application/Register.php">Registrarse</a>
                </nav>
            </div>
        </header>

        <hr>

        <!-- Bienvenida -->
        <main class="px-3">
            <h1>Bienvenido/a</h1>
            <div>
                <p class="lead text-justify">
                    Nuestra aplicación está diseñada para simplificar la gestión de citas médicas y el control de
                    inventario de medicamentos. Ofrece un entorno intuitivo donde los usuarios pueden programar,
                    modificar y cancelar citas, además de llevar un registro detallado del inventario de productos
                    médicos. Ideal para clínicas y hospitales que buscan optimizar sus procesos administrativos.
                </p>
            </div>
            <hr>

            <!-- Acerca de -->
            <h1><i class="bi bi-info-circle-fill icon-spacing"></i> Acerca De</h1>
            <div>
                <p class="lead text-justify">
                    Este sistema combina la gestión de pacientes y citas con un control eficiente del inventario de
                    medicamentos y proveedores. Está pensado para mejorar la coordinación entre el personal médico y
                    administrativo, garantizando que los pacientes reciban la atención que necesitan y que siempre haya
                    un stock suficiente de productos esenciales.
                </p>
                <h3><i class="bi bi-person-check-fill icon-spacing"></i> Misión</h3>
                <p class="lead text-justify">
                    Nuestra misión es proporcionar una plataforma confiable y eficiente para la gestión de citas médicas
                    y el control del inventario de medicamentos, mejorando la coordinación entre el personal médico y
                    administrativo. Nos esforzamos por asegurar que cada paciente reciba la atención oportuna y de
                    calidad, mientras mantenemos un flujo constante y adecuado de suministros médicos esenciales.
                </p>

                <h3><i class="bi bi-suit-heart-fill icon-spacing"></i> Visión</h3>
                <p class="lead text-justify">
                    Nuestra visión es convertirnos en la solución líder en el ámbito de la gestión médica digital,
                    facilitando el acceso a herramientas que optimicen la eficiencia operativa en clínicas y hospitales
                    de todo el mundo. Aspiramos a innovar continuamente para mejorar la experiencia del paciente y la
                    efectividad del cuidado de la salud, garantizando la disponibilidad constante de recursos médicos
                    críticos.
                </p>
            </div>
            <hr>

            <!-- Servicios -->
            <h1><i class="bi bi-boxes icon-spacing"></i> Servicios</h1>
            <div>
                <p class="lead text-justify">
                    Nuestra plataforma está diseñada para facilitar la administración tanto de citas médicas como del
                    inventario de medicamentos, ofreciendo una solución integral para clínicas y hospitales. Con un
                    enfoque en la eficiencia y la facilidad de uso, este sistema garantiza un flujo de trabajo óptimo y
                    la satisfacción de los pacientes.
                </p>

                <h3><i class="bi bi-calendar-check-fill icon-spacing"></i> Agendación de Citas</h3>
                <p class="lead text-justify">
                    El módulo de agendación de citas permite a los usuarios programar, modificar y cancelar citas de
                    manera rápida y eficiente. Con notificaciones automáticas, recordatorios y una interfaz intuitiva,
                    los profesionales médicos pueden gestionar su agenda con facilidad, mientras los pacientes reciben
                    confirmaciones oportunas y precisas sobre sus citas.
                </p>

                <h3><i class="bi bi-capsule icon-spacing"></i> Inventario de Medicamentos</h3>
                <p class="lead text-justify">
                    El control del inventario de medicamentos es fundamental para asegurar un servicio médico de
                    calidad. Nuestro sistema permite registrar, actualizar y supervisar el stock de cada producto en
                    tiempo real, lo que garantiza que los medicamentos siempre estén disponibles cuando se necesiten.
                    Además, cuenta con alertas para productos próximos a su fecha de vencimiento y reportes de stock
                    bajo, asegurando una gestión eficiente del inventario.
                </p>
            </div>
        </main>
        <hr>

        <!-- Pie de página -->
        <footer class="mt-auto text-white-50">
            <p>Contacto:
                <a href="https://www.linkedin.com" class="text-white" target="_blank"><i class="bi bi-linkedin"></i>
                    LinkedIn</a> |
                <a href="https://www.instagram.com" class="text-white" target="_blank"><i class="bi bi-instagram"></i>
                    Instagram</a> |
                <a href="mailto:contacto@gaes8.com" class="text-white"><i class="bi bi-envelope"></i> Email</a>
            </p>
            <p>Proyecto SENA <a href="#" class="text-white">2024</a>, por <a href="#" class="text-white">GAES 8</a>.</p>
        </footer>
    </div>
</body>

</html>