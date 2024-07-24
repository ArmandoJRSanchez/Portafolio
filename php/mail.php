<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar reCAPTCHA
    $recaptchaSecret = '6Lew6BYqAAAAAEAj-lGlT8xGBBgAC2ycAJD8wB7P';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        $mensaje =  'Error: Verificación reCAPTCHA fallida. Por favor, inténtalo de nuevo.';
        exit;
    }

    // Datos del formulario
    $asunto = $_POST['asunto'];
    $name = $_POST['nombre'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validar datos
    if (empty($name) || empty($email) || empty($message) || empty($asunto)) {
        $mensaje =  'Error: Todos los campos son obligatorios.';
        exit;
    }

    // Enviar correo
    $to = 'armandojoel.contacto@gmail.com';
    $subject = 'Nuevo mensaje de contacto, ' . $asunto;
    $body = "Nombre: $name\nCorreo electrónico: $email\n\nMensaje:\n$message";
    $headers = 'From: remitente@example.com' . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $body, $headers)) {
        $mensaje =  'Correo enviado exitosamente';
    } else {
        $mensaje =  'Error al enviar el correo';
    }
} else {
    $mensaje =  'Método de solicitud no válido';
}
?>
