<?php

if(isset($_POST['req']) && $_POST['req']=="MAILSEND"){
	require './mailer/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	if(mail("nimalakanth@gmail.com", "Test Subject", "Test Message"))
	echo "wow";
	else
	echo "Pitty";
	$mail->isSMTP();  
	$mail->IsMAIL();                                    // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'ibmgsindia@gmail.com';                 // SMTP username
	$mail->Password = 'welcome2ibm';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 25;                                    // TCP port to connect to
	
	$mail->setFrom('ibmgsindia@gmail.com', 'KYGMC Mailer');
	//$mail->addAddress('gaurav.sanyal@in.ibm.com', 'Gaurav Sanyal');
	$mail->addAddress('nimalakanth@gmail.com', 'Nimalakanth');
	$mail->addCC('infoarijitdas@gmail.com', 'Arijit');
	$mail->addBCC('aridas01@in.ibm.com', 'Mahanth');     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	$mail->addReplyTo('', '');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = 'Action needed: A new stakeholder has expressed interest to visit GMC India';
	$mail->Body    = '<p>Hi Gaurav,<br><br>
	A new stakeholder has just signed up for a visit to GMC india. Please use the email ID below to fetch the stakeholder\'s details from bluepages. This is a system generated email. Please do not reply to this ID and contact the respective discipline leader to which the stakeholder belongs to chart the next steps. Thanks.<br><br>';
	$mail->Body    .='<strong>Visitor Email ID:<strong><br>'. $_POST['emailid']."<br>";
	$mail->Body    .='<strong>Comments:</strong><br>'. $_POST['comments']."<br><br>";
	$mail->Body    .='For opting out of this email communication or for any other questions related to this automatic email setup, please reach out to : Nimalakanth Krishnasamy or  Mahanth Chavutagunta <br><br>
	Blue pages link - <a href="http://w3.ibm.com/newbp/" target="_blank">http://w3.ibm.com/newbp/</a>';
	$mail->AltBody = '';
	print_r($mail);
	if(!$mail->send()) {
		$data = array('ret'=>'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
	} else {
		$data = array('ret'=>'SUCCESS');
	}
	echo json_encode($data);
}

?>