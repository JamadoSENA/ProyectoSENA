<?php
// Función para sanitizar entradas de texto
function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Función para validar correos electrónicos
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Función para validar enteros
function validate_integer($value) {
    return filter_var($value, FILTER_VALIDATE_INT) !== false;
}

// Puedes agregar más funciones de validación y sanitización según tus necesidades
?>