<?php
session_start();
require_once('config/config.php');

SSLon();
//Tänne tullaan kun ilogSign.php lomakkeella painetaan Kirjaudu painiketta
//Kayttaja/salasana kannassa?
//user oliossa kayttajatiedot jos ok, muuten false

$user = login($_POST['username'], $_POST['pwd'], $DBH);
//print_r($user);
if(!$user){
    $_SESSION['loggausvirhe'] = 'jep';
    //Aiheuttaa alert() pääsivulla
    redirect("register.php");
} else {
    unset($_SESSION['loggausvirhe']);
    //Jos käyttäjätunnistettiin, talletetaan tiedot sessioon esim. kassalle siirtymistä
    //varten on hyvä tietää asiakastiedot
    $_SESSION['kirjautunut'] = 'yes';
	$_SESSION['email'] = $user->email;
    $_SESSION['username'] = $user->username;
	$_SESSION['pwd'] = $user->pwd;

	//Jos loggaus onnistuu niin palataan paasivulle
    redirect('index.php');
}

?>
