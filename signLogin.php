<?php
session_start();
?>
Tähdellä merkityt kentät ovat pakollisia.
<form action="login.php" method="post">

    <input type="text" name="username" placeholder="Username" required><span>*</span>
    <br>
    <input type="password" name="pwd" placeholder="Password" required><span>*</span>
    <br>

    <input type="submit" value="Log In">
</form>
