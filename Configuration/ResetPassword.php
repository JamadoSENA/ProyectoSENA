<?php

require_once ("Connection.php");

// Replace with your email server details
$from = "me@example.com";
$to = ""; // This will be filled from the form
$subject = "Recuperar Contraseña - MediStock";
$message = "";

if (isset($_POST['correo'])) {
  $to = $_POST['correo'];

  // Generate a random password reset token (improve security with stronger methods)
  $token = md5(uniqid(rand(), true));

  // Replace with your database logic to store the token for the user's email
  // This is a placeholder, implement proper database interaction

  $message = "Hola,\n\nPara recuperar tu contraseña de MediStock, haz clic en el siguiente enlace:\n\n";
  $message .= "http://yourwebsite.com/reset-password.php?token=" . $token . "\n\n";
  $message .= "Si no solicitaste un restablecimiento de contraseña, puedes ignorar este correo electrónico.\n\n";
  $message .= "Atentamente,\nEl equipo de MediStock";

  // **Using ini_set to potentially improve email sending reliability**
  // **Comment out this section if you don't want to use ini_set**
   ini_set('sendmail_path', '/usr/sbin/sendmail'); // Adjust the path if needed
   ini_set('smtp_server', 'smtp.gmail.com'); // Replace with your SMTP server
   ini_set('smtp_port', 587); // Replace with your SMTP port (might be different for Gmail)

  // Function to send the email (replace with a proper mailing library for best results)
  $sent = mail($to, $subject, $message, "From: " . $from);

  if ($sent) {
    echo "Correo enviado exitosamente. Revisa tu bandeja de entrada para restablecer tu contraseña.";
  } else {
    echo "Ocurrió un error al enviar el correo. Intenta nuevamente más tarde.";
  }
}

?>