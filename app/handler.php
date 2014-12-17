<?php 

	extract($_POST); // name, email, industry, page

	$file = 'signups.csv';
	$data = file_get_contents($file);
	
	$data.= "$name,$email,$industry\n";

	file_put_contents($file, $data);

	$message = "
		Someone signed up through a landing age. \n\n
		They have been added to <a href='https://adviicemrkt.com/signups.csv'>the signups csv</a>\n\n
		<strong>Name: $name</strong> \n
		<strong>Email: $email</strong> \n
		<strong>Industry: $industry</strong> \n
		<strong>Landing Page: $page</strong> \n
	";

	$headers  = "From: signups@adviicemrkt.com\r\nReply-To: signups@adviicemrkt.com";
	$headers .= "Cc: harley@marketingpartners.com.au\r\n";

	$sent = mail('kristen@marketingpartners.com.au', 'New signup through landing pages', $message, $headers);

	if($sent)
		$response = array('success' => 'person added successfully');
	else
		$response = array('error' => 'person wasn\'nt emailed');
	
	header('Content-Type: application/json');
	echo json_encode($response);

	exit;

?>