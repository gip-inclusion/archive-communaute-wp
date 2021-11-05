<?php
// Enable error reporting
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );


// Test php mail()
if ( function_exists( 'mail' ) ) {
	echo "mail() est  disponible";
} else {
	echo "mail() n'est pas disponible";
}

echo "<br><br>";

if(isset($_GET['from'])) {
	$from = $_GET['from'];
	$to = $_GET['to'];
	$subject = "Test pour la fonction de messagerie php";
	$message = "Ceci est un test pour vérifier si la fonction de messagerie php envoie l'e-mail ";
	$headers = "From:" . $from;

	if(mail($to,$subject,$message, $headers))  {
		echo "Test email envoyé à ".$to;
	} else {
		echo "Échec de l'envoi à ".$to;
	}		
} else {
	echo "Pour envoyer un email test, il faut renseiger les 2 variables <i>from</i> et <i>to</i> dans l'url et recharger la page. <br>Exemple: https://communaute.inclusion.beta.gouv.fr/test.php?from=email@inclusion.beta.gouv.fr&to=davidwatrelot@gmail.com";
}




echo "<br><br>";




// Test wp_mail()
$to = "davidwatrelot@gmail.com";
$subject = 'wp_mail function test';
$message = 'This is a test of the wp_mail function: wp_mail is working';
$headers = '';
 
// Load WP components, no themes.
define('WP_USE_THEMES', false);
require('wp-load.php');
 
// send test message using wp_mail function.
$sent_message = wp_mail( $to, $subject, $message, $headers );

//display message based on the result.
if ( $sent_message ) {
	// The message was sent.
	echo 'The test message was sent to davidwatrelot@gmail.com. Check your email inbox.';
} else {
	// The message was not sent.
	echo 'The message was not sent!';
}
?>
