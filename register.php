<?php
session_start();
    ?>
Tähdellä merkityt kentät ovat pakollisia.
<form action="confirm.php" method="post">

    <input type="text" name="data[username]" placeholder="Username" required><span>*</span>
    <br>
    <input type="email" name="data[email]" placeholder="Email" required><span>*</span>
    <br>
    <input type="password" name="data[pwd]" placeholder="Password" required><span>*</span>
    <br>
    <input type="password" name="confirmPwd" placeholder="Confirm Password" required><span>*</span>
    <br>

    <input type="submit" value="Save">
</form>

<script>
  const salasana = document.querySelector('input[name="data[pwd]"]');
  const varmistus = document.querySelector('input[name="confirmPwd"]');
  const fillPattern = function(){
    varmistus.pattern = this.value;
  }
  salasana.addEventListener('keyup', fillPattern);
</script>
