<?php //todo
            if (isset($_GET['registerSuccessful'])) 
            echo 'Rejestracja przebiegła pomyślnie!<br>'
?>
    <form class ="login" action="<?php echo URLROOT."/login/tryToLogin"?>" method="post">

        <input type="email" <?php if(isset($_SESSION['errorEmptyLogin'])||isset($_SESSION['errorBadAuthorize']))echo "class='error'";?> id="email" name="email" placeholder="E-mail"><br>
        <input type="password" <?php if(isset($_SESSION['errorEmptyLogin'])||isset($_SESSION['errorBadAuthorize']))echo "class='error'";?> id="password" name="password" placeholder="Hasło"><br>
        <input type="submit" value="Zaloguj">
    </form>
   
    <?php
    if (isset($_SESSION['errorEmptyLogin']))echo $_SESSION['errorEmptyLogin'];
    if (isset($_SESSION['errorBadAuthorize']))echo $_SESSION['errorBadAuthorize'];
    ?>
     <br>
    Jeśli nie masz jeszcze założonego konta<br>
    <a href="<?php echo URLROOT."/register"?>">kliknij tutaj</a>
  