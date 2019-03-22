<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["comment"]) ) {
    die ("It is necessary to complete all the form data");
}
$name = $_POST["name"];
$email = $_POST["email"];
$comment = $_POST["comment"];

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "c1440130.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "info@dasmeerblau.com.ar";  // Mi cuenta de correo
$smtpClave = "ESC77esc";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "info@dasmeerblau.com.ar";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $smtpUsuario; // Email desde donde envío el correo.
$mail->FromName = $name;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario
$mail->AddReplyTo($email); // Esto es para que al recibir el correo y poner Responder, lo haga a la cuenta del visitante. 
$mail->Subject = "Das Meer Blau - Contact Form"; // Este es el titulo del email.
$commentHtml = nl2br($comment);
$mail->Body = "{$commentHtml} <br /><br />Form By Das Meer Blau<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$comment} \n\n Formu By Das Meer Blau"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "The mail was sent correctly.";
} else {
    echo "Please Try Again.";
}
