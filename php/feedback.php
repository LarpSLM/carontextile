<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/Exception.php';
require 'lib/PHPMailer.php';
require 'lib/SMTP.php';

//$RECIPIENT =  '6499076@mail.ru'
$FROM = 'site-feedback@carontextile.ru';
$FROM_NAME = 'Caron Textile (Форма обратной связи)';

$RECIPIENT =  'cupofwonder@yandex.ru';
$RECIPIENT_NAME = 'Caron Textile';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
	$name = extractFromPost('name', 64);
	$userEmail = extractFromPost('e-mail', 64);
	$userPhone = extractFromPost('phone', 64);
	$message = extractFromPost('question', 5000);
	
    //Server settings
    //$mail->SMTPDebug = 2; 
    $mail->isSMTP();                                // Set mailer to use SMTP
    $mail->Host = 'localhost';						// Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                        // Enable SMTP authentication
    $mail->Username = '';                 			// SMTP username
    $mail->Password = '';                           // SMTP password
//    $mail->SMTPSecure = 'starttls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to
    
    $mail->SMTPOptions = array(
		'ssl' => array(
		    'verify_peer' => false,
		    'verify_peer_name' => false,
		    'allow_self_signed' => true
		)
	);

    //Recipients
    $mail->setFrom($FROM, $FROM_NAME);
    $mail->addAddress($RECIPIENT, $RECIPIENT_NAME);     // Add a recipient
    
    if(!empty($userEmail)) {
	    $mail->addReplyTo($userEmail, $name);
    }

    //Content
    $mail->Subject = "Обратная связь ($name)";
    $mail->Body    = "Пользователь $name оставил вопрос:\n\n$message"
	."\n\nОбратная связь с пользователем:\nE-mail:$userEmail\nТелефон:$userPhone";
    

    $mail->send();
	redirectToSuccess();
} catch (Exception $e) {
	redirectToError();
}

function redirectToSuccess() {
	header('Location: /mail-success.html');
}

function redirectToError() {
	header('Location: /mail-error.html');
}

function extractFromPost($name, $len) {
	if(array_key_exists($name, $_POST)) {
		$raw = $_POST[$name];
	
		if($raw != null && is_string($raw)) {
			return substr($raw, 0, $len);
		}
	} else {
		return "";	
	}
}
