<?php
session_start();
?>
<?php
require_once('config/config.php');

SSLon();

$userdata = unserialize($_SESSION['lomakedata']);  //tekstimuodosta takaisin taulukoksi
$data['email'] = $userdata['email'];
try {
    $STH = $DBH->prepare("SELECT * FROM users WHERE email= :email");
    $STH->execute($data);
    $row = $STH->fetch();  //Löytyiko sama email osoite?
    if ($STH->rowCount() == 0) { //Jos ei niin rekisteröidään
// lisää suola '!!'
        $userdata['pwd'] = md5($userdata['pwd'] . '!!');  //hashataan salasana suolalla
        var_dump($userdata);
        try {
            $STH2 = $DBH->prepare("INSERT INTO users (username, pwd, email)
VALUES (:username, :pwd, :email);");
            if ($STH2->execute($userdata)) {
                try {
//Jos käyttäjän tallennus onnistui asetetaan hänet loggautuneeksi
//eli kirjoitetaan käyttäjätiedot myös sessiomuuttujiin
                    $sql = "SELECT * FROM users WHERE memberID = " . $DBH->lastInsertId() . ";";
                    $STH3 = $DBH->query($sql);
                    $STH3->setFetchMode(PDO::FETCH_OBJ);
                    $user = $STH3->fetch();
                    $_SESSION['kirjautunut'] = 'yes';
                    $_SESSION['username'] = $user->username;
                    $_SESSION['pwd'] = $user->pwd;
                    $_SESSION['email'] = $user->email;

                   redirect('index.php');  //Palaa heti index.php sivulle
                } catch (PDOException $e) {
                    echo 'Käyttäjän tietojen hakuerhe';
                    file_put_contents('log/DBErrors.txt', 'tallennaKayttaja 3:
' . $e->getMessage() . "\n", FILE_APPEND);
                }
            }
        } catch (PDOException $e) {
            echo 'Tietojen lisäyserhe'.$e->getMessage();
            file_put_contents('log/DBErrors.txt', 'tallennaKayttaja 2: ' . $e->getMessage() . "\n",
                FILE_APPEND);
        }
    } else {
        echo 'Käyttäjä on jo olemassa.';
    }
} catch (PDOException $e) {
    echo 'Tietokantaerhe.';
    file_put_contents('log/DBErrors.txt', 'tallennaKayttaja 1: ' . $e->getMessage() . "\n", FILE_APPEND);
} ?>
