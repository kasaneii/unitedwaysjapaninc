<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Adjust path if needed

$mail = new PHPMailer(true);

$name  = $_REQUEST["name"];
$email = $_REQUEST["email"];
$subject = $_REQUEST["subject"];
$msg   = $_REQUEST["msg"];
$to    = "";

try {
	if (isset($email) && isset($name) && isset($msg)) {
    	$mail->isSMTP();
    	$mail->Host       = 'smtp.gmail.com';
    	$mail->SMTPAuth   = true;
    	$mail->Username   = 'your_email@gmail.com';
    	$mail->Password   = 'your_app_password'; // App password only
    	$mail->SMTPSecure = 'tls';
    	$mail->Port       = 587;

    	$mail->setFrom($email, $name);
    	$mail->addAddress($to);

    	$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';
    	$mail->Subject = 'New Contact Form Submission ('.$subject.') — United Ways Japan Inc.';
    	$mail->Body    = "<div style='font-size: 16px;'>
        					<p><strong>You’ve received a new inquiry from the contact form.</strong><br/>
								<span>Please review the details below:</span>
							</p>
        					<p>$msg</p>
    					</div>";

    	if($mail->send()){
			echo 'success';
		} else {
			echo 'failed';
		}
	}
} catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
