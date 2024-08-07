<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptcha_secret = 'TU_SECRET_KEY_AQUI'; // Reemplaza con tu clave secreta
    $recaptcha_response = $_POST['g-recaptcha-response'];
    
    // Verifica el CAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
    $responseKeys = json_decode($response, true);
    
    if(intval($responseKeys["success"]) !== 1) {
        echo "Por favor, verifica que no eres un robot.";
        exit;
    }
    // Recoger los datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Definir el destinatario del correo
    $to = 'agustinsuare01@gmail.com'; // Cambia esto por tu correo electrónico

    // Definir el asunto del correo
    $subject = 'Nuevo mensaje desde el formulario de contacto';

    // Crear el contenido del correo
    $email_content = "Nombre: $name\n";
    $email_content .= "Correo Electrónico: $email\n";
    $email_content .= "Mensaje:\n$message\n";

    // Crear los encabezados del correo
    $headers = "From: $email";

    // Enviar el correo
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Correo enviado correctamente.";
    } else {
        echo "Hubo un error al enviar el correo.";
    }
} else {
    echo "Solicitud inválida.";
}
?>
