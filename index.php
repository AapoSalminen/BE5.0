
<?php
session_start();
/**
 * Created by PhpStorm.
 * User: raouff
 * Date: 28.11.2017
 * Time: 15.23
 */
require_once ('config/config.php');

echo "welcome";
echo '<br>';
if($_SESSION['kirjautunut'] == 'yes'){
    //Ladataan tämä (käyttäjän tiedot

echo('<p>Käyttäjätiedot</p>');
echo '<div class="tiedot">';
echo 'Username: '.$_SESSION['username'];
echo '<br>';
echo 'Email: '.$_SESSION['email'];
echo '<br>';
echo('<a href="logout.php" class="button punainen">Kirjaudu ulos</a>');
echo '</div>';

}else{
    //Näytetään lomake
    echo('<a href="signLogin.php">Login</a>');
    echo '<br>';
    echo('<a href="register.php">Register</a>');
}
?>