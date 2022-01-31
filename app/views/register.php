<link rel="stylesheet" href="<?php echo URLROOT;?>/css/logreg.css" /></head>
<body>
<div class ="logreg">
    <form  action="<?php echo URLROOT."/register/registerUser"?>" method="post">
        <input type="email" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="email" name="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" maxlength="255" required>
        <?php
        if (isset($_SESSION['errorWrongEmailSize']))echo $_SESSION['errorWrongEmailSize'];
        ?>
        <br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="password" name="password" placeholder="Hasło" minlength="8" maxlength="255" required> 
        <?php
        if (isset($_SESSION['errorWrongPasswordSize']))echo $_SESSION['errorWrongPasswordSize'];
        ?>
        <br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="confirmPassword" name="confirmPassword" placeholder="Powtórz hasło" required minlength="8" maxlength="255">
        <?php
        if (isset($_SESSION['errorWrongConfirmPasswordSize']))echo $_SESSION['errorWrongConfirmPasswordSize'];
        ?>
        <br>
        <input type="tel" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="phone" name="phone" pattern="[0-9]{9}" placeholder="Telefon" minlength="9" maxlength="9" required>
        <?php
        if (isset($_SESSION['errorWrongPhoneSize']))echo $_SESSION['errorWrongPhoneSize'];
        ?>
        <br>
        <input type="submit" value="Zarejestruj" id="submit">
    </form>
    <?php
    if (isset($_SESSION['errorIncompleteRegisterData']))echo $_SESSION['errorIncompleteRegisterData'];
    if (isset($_SESSION['errorDataAlreadyExists']))echo $_SESSION['errorDataAlreadyExists'];
    ?>
    
    <a href="<?php echo URLROOT."/login"?>">Jeśli masz już założone konto<br>kliknij tutaj</a>
</div>    
    
</body>