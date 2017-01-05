<?php
//error_reporting(E_ALL);

if(isset($_POST['req']) && $_POST['req']=="MAILSEND"){
	
	$url = 'http://www.nimocode.com/services/kygmc/sendmail.php';
	//$url = 'http://localhost:8888/know-your-gmc/nimocode/sendmail.php';
	$fields_string = http_build_query($_POST);

	//open connection
	$ch = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($_POST));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	//execute post
	$result = curl_exec($ch);
	//close connection
	curl_close($ch);
	
	if(!$result) {
		$data = array('ret'=>'Message could not be sent. Mailer Error: ' . $result);
	} else {
		$data = array('ret'=>'SUCCESS');
	}
	echo json_encode($data);
	//print_r($data);
}

?>