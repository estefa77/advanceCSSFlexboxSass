<?php
$usersmtp ="info@dasmeerblau.com.com"; // Entre las comillas va una cuenta de correo de su panel de control
$pass="esc77ESC"; // Entre las comillas va el password de la cuenta de correo 
$destino="info@dasmeerblau.com.com"; // Entre las comillas la direccion de correo donde va a recibir los mails 

// Se verifica que los datos han sido enviados desde el formulario, para la validación con el SMTP
if ( $_POST['enviar'] == "1")
{
if ( $_POST['name'] != "" && $_POST['email'] != "" && $_POST['comment'] != "" )

{
// Se incluye la librería necesaria para el envio
require_once("fzo.mail.php");

$mail = new SMTP("localhost",$usersmtp,$pass);

// Se configuran los parametros necesarios para el envío
$de = $usersmtp ;
$a = $destino;
$asunto = "E-mail Contacto";
$cc = $_POST['cc'];
$bcc = $_POST['bcc'];


$cuerpo = "Este es un e-mail enviado desde el formulario de contacto de la pagina\n\n";
$cuerpo .= "Name: " .$_POST['name'] . "\n";
$cuerpo .= "Email: " .$_POST['email'] . "\n";
$cuerpo .= "Comment: " .$_POST['comment'] . "\n";


$header = $mail->make_header(
$de, 
$a, 
$asunto, 
$_POST['prioridad'], 
$cc, 
$bcc
);

/*	
Pueden definirse más encabezados. Tener en cuenta la terminación de la 
linea con (\r\n)

$header .= "Reply-To: ".$_POST['from']." \r\n";
$header .= "Content-Type: text/plain; charset=\"iso-8859-1\" \r\n";
$header .= "Content-Transfer-Encoding: 8bit \r\n";
$header .= "MIME-Version: 1.0 \r\n";
*/

// Se envia el correo y se verifica el error
$error = $mail->smtp_send($de, $a, $header, $cuerpo, $cc, $bcc);
if ($error == "0")

header("Location: contact.html");


else
echo $error;
}
else
{

echo("Complete los campos Requeridos ");
}
}
?>