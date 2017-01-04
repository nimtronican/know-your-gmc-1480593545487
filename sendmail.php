<?php
require './mailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'admin@knowyourgmc.ibm.com';                 // SMTP username
$mail->Password = 'notavailable';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('nimalakanth@gmail.com', 'KYGMC Visitor');
$mail->addAddress('nimalakanth@in.ibm.com', 'Nimalakanth');
$mail->addAddress('mchavuta@in.ibm.com', 'Nimalakanth');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('nimalakanth@in.ibm.com', 'Nimalakanth');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'New Visit GMC Request from ';
$mail->Body    = 'There is a new Visit GMC request from our Webpage Contact Module';
$mail->AltBody = 'There is a new Visit GMC request from our Webpage Contact Module';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>