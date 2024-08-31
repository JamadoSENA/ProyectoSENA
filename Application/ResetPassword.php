<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Asegúrate de ajustar la ruta si no usas Composer
require '../Configuration/Connection.php'; // Archivo para conectar con la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);

    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Verificar si el correo existe en la base de datos
        $stmt = $conexion->prepare("SELECT idUser FROM users WHERE email = ?");
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $conexion->error);
        }
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Generar un código de recuperación aleatorio
            $codigoRecuperacion = bin2hex(random_bytes(4)); // Genera un código de 8 caracteres hexadecimales

            // Enviar el código por correo electrónico
            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'gaes8medistock@gmail.com';
                $mail->Password = 'lvgzpyxfrjohjiud'; // Usa contraseñas de aplicación si es necesario
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Destinatario
                $mail->setFrom('gaes8medistock@gmail.com', 'Medistock');
                $mail->addAddress($correo);

                // Contenido
                $mail->isHTML(true);
                $mail->Subject = 'Codigo de Recuperacion de Contrasenia';
                $mail->Body    = 'Tu código de recuperación es: <b>' . $codigoRecuperacion . '</b>';

                $mail->send();

                // Guardar el código de recuperación en la base de datos
                $stmtUpdate = $conexion->prepare("UPDATE users SET code = ? WHERE email = ?");
                if ($stmtUpdate === false) {
                    die('Error al preparar la consulta: ' . $conexion->error);
                }
                $stmtUpdate->bind_param("ss", $codigoRecuperacion, $correo);
                if ($stmtUpdate->execute()) {
                    header("Content-Type: text/html; charset=UTF-8");

                    echo "<!DOCTYPE html>
                    <html lang='es'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Registro Exitoso</title>
                        <link rel='shortcut icon' href='Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                        <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
                    </head>
                    <body>
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                        <script>
                            Swal.fire({
                                title: '¡Excelente!',
                                text: 'En unos instantes recibiras el codigo en tu correo.',
                                icon: 'success'
                            }).then(function() {
                                window.location = 'Verification.php'; // Redirige después de cerrar el Swal
                            });
                        </script>
                    </body>
                    </html>";
                } else {
                    header("Content-Type: text/html; charset=UTF-8");

                    echo "<!DOCTYPE html>
                    <html lang='es'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Oh oh...Error Inesperado</title>
                        <link rel='shortcut icon' href='Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                        <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
                    </head>
                    <body>
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                        <script>
                            Swal.fire({
                                title: '¡Error!',
                                text: 'Ocurrio un error inesperado al actualizar el codigo de recuperacion.',
                                icon: 'error'
                            }).then(function() {
                                window.location = 'Verification.php'; // Redirige después de cerrar el Swal
                            });
                        </script>
                    </body>
                    </html>";
                }
                $stmtUpdate->close();

            } catch (Exception $e) {
                echo 'Error al enviar el correo: ', $mail->ErrorInfo;
            }
        } else {
            header("Content-Type: text/html; charset=UTF-8");

            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Correo No Encontrado</title>
                <link rel='shortcut icon' href='Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Error!',
                        text: 'No se encontro el correo digitado.',
                        icon: 'error'
                    }).then(function() {
                        window.location = 'Verification.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
        }
        $stmt->close();
    } else {
        header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Correo Invalido</title>
            <link rel='shortcut icon' href='Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'El correo ingresado no es válido.',
                    icon: 'error'
                }).then(function() {
                    window.location = 'Verification.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";
    }
}
?>

