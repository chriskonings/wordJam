<?php
	$to      = $_POST['receiver'];
	$message = $_POST['mytextarea'];
	$headers = 'From: wordjam@chriskonings.com' . "\r\n" .
	'Reply-To: wordjam@chriskonings.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	mail($to, 'Message Via WordJam', $message, $headers);
	echo "Mail Sent.";
?>