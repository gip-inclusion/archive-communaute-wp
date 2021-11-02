<?php
	/*
	* Enable error reporting
	*/
	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL );


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
?>
