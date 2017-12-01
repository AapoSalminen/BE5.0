<?php
session_start();
require_once('config/config.php');
SSLon();
session_destroy();   //tuhoa sessio!
redirect('index.php'); //siirry kotisivulle
?>
