<link rel="stylesheet" href="<?php echo URLROOT;?>/css/logreg.css" /></head>
<?php //todo
            if (isset($_GET['registerSuccessful'])) 
            echo 'Rejestracja przebiegła pomyślnie!<br>'
?>
<div class ="logreg">
    <form action="<?php echo URLROOT."/login/tryToLogin"?>" method="post">

        <input type="email" <?php if(isset($_SESSION['errorIncompleteLoginData'])||isset($_SESSION['errorInvalidPassword']))echo "class='error'";?> id="email" name="email" placeholder="E-mail" 
                style="width: 170px;
                background-color: #bfe8e3 !important;
                color: #269ca3 !important;
                font-size: 15px;
                padding: 10px;
                box-sizing: border-box;
                margin-top: 5px;
                border: 2px solid #a5ded7 !important;">
    <br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteLoginData'])||isset($_SESSION['errorInvalidPassword']))echo "class='error'";?> id="password" name="password" placeholder="Hasło"
                style="width: 170px;
                background-color: #bfe8e3 !important;
                color: #269ca3 !important;
                font-size: 15px;
                padding: 10px;
                box-sizing: border-box;
                margin-top: 5px;
                border: 2px solid #a5ded7 !important;">
    <br>
        <input type="submit" value="Zaloguj"
                style="    width: 170px;
                background-color: #84dbd1;
                font-size: 20px;
                color: white;
                padding: 15px 10px;
                margin-top: 10px;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                letter-spacing: 2px;">
    </form>
   
    <?php
    if (isset($_SESSION['errorIncompleteLoginData']))echo $_SESSION['errorIncompleteLoginData'];
    if (isset($_SESSION['errorInvalidPassword']))echo $_SESSION['errorInvalidPassword'];
    ?>
     <br>
    Jeśli nie masz jeszcze założonego konta<br>
    <a href="<?php echo URLROOT."/register"?>">kliknij tutaj</a>
</div>