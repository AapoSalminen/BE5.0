<?php
session_start();
//Lomakkeen syöttötiedot $data[] taulukossa
$data = $_POST['data'];
//Laitetaan syötetyt tiedot sessioon jemmaan, jotta voidaan palata muuttamaan annettuja arvoja
$_SESSION['lomakedata'] = serialize($data);

//Ovatko nimi ja email oikein? Nyt tarkistus palvelimella
if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {  //valmis php funktio
if(preg_match("/^[a-z\d_]{2,50}$/i",$data['username'])) { //Sallitaan kirjaimia, numeroita ja _
//* on “useita”   ^  on “täytyy alkaa”
echo '<div class="tiedot">';
    echo 'Username: '.$data['username'];
    echo '<br>';
    echo 'Email: '.$data['email'];
    echo '<br>';
    echo '</div>';
echo '<a href="saveUser.php" class="button sininen">Save</a>';
echo '<br>';
}else {
echo("<h3>INVALID USERNAME(only a-z,0-9,'_' are accepted): <br />"
    .$data['username'] ."</h3>");
}
}else{
echo("<h3>INVALID EMAIL ADRESS: <br />"
    .$data['email']."</h3>");
}
echo '<a href="register.php" class="button punainen">Back</a>';
?>
