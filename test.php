<?php
	if ( function_exists( 'mail' ) ) {
			echo 'mail() is available';
	} else {
			echo 'mail() has been disabled';
	}

	/*
		* Enable error reporting
		*/
	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL );

	/*
		* Setup email addresses and change it to your own
		*/
	$from = "email@communaute-prod.cleverapps.io";
	$to = "davidwatrelot@gmail.com";
	$subject = "Simple test for mail function";
	$message = "This is a test to check if php mail function sends out the email";
	$headers = "From:" . $from;

	/*
		* Test php mail function to see if it returns "true" or "false"
		* Remember that if mail returns true does not guarantee
		* that you will also receive the email
		*/
	if(mail($to,$subject,$message, $headers))  {
		echo "Test email send.";
	} 
	else 
	{
		echo "Failed to send.";
	}
?>
