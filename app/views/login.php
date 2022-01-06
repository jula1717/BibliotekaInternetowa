<link rel="stylesheet" href="<?php echo URLROOT;?>/css/logreg.css" /></head>
<?php //todo
            if (isset($_GET['registerSuccessful'])) 
            echo 'Rejestracja przebiegła pomyślnie!<br>'
?>
<div class ="logreg">
    <form action="<?php echo URLROOT."/login/tryToLogin"?>" method="post">

        <input type="email" <?php if(isset($_SESSION['errorIncompleteLoginData'])||isset($_SESSION['errorInvalidPassword']))echo "class='error'";?> id="email" name="email" placeholder="E-mail">
    <br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteLoginData'])||isset($_SESSION['errorInvalidPassword']))echo "class='error'";?> id="password" name="password" placeholder="Hasło">
    <br>
        <input type="submit" value="Zaloguj" id="submit">
    </form>
   
    <?php
    if (isset($_SESSION['errorIncompleteLoginData']))echo $_SESSION['errorIncompleteLoginData'];
    if (isset($_SESSION['errorInvalidPassword']))echo $_SESSION['errorInvalidPassword'];
    ?>
     <br>
    Jeśli nie masz jeszcze założonego konta<br>
    <a href="<?php echo URLROOT."/register"?>">kliknij tutaj</a>
</div>