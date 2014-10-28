<?php
require_once('/PHPMailer-master/PHPMailerAutoload.php');

function ac_mail( $address, $body){

	$mail             = new PHPMailer();
//	$body             = file_get_contents('contents.html');
//	$body             = eregi_replace("[\]",'',$body);

	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "alebaggio91@gmail.com"; // SMTP account username
	$mail->Password   = "diegoanna";        // SMTP account password

	$mail->SetFrom('alebaggio91@gmail.com');

	$mail->AddReplyTo("alebaggio91@gmail.com");

	$mail->Subject    = "Password";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	echo "1";
	$mail->MsgHTML($body);
	echo "2";
	$mail->AddAddress($address);
	echo "3";
	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	  return false;
	} else {
	  echo "Message sent!";
	  return true;
	}
}
?>
    