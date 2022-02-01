<link rel="stylesheet" href="<?php echo URLROOT;?>/css/logreg.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
</head>
<body>
<div class ="logreg">
    <form  action="<?php echo URLROOT."/register/registerUser"?>" method="post">
        <input type="email" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="email" name="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" maxlength="255" required>
        <i class="icon-search help" title="Wprowadź email."></i>
        <?php
        if (isset($_SESSION['errorWrongEmailSize']))echo $_SESSION['errorWrongEmailSize'];
        ?>
        <br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="password" name="password" placeholder="Hasło" minlength="8" maxlength="255" required> 
        <i class="icon-search help" title="Wprowadź hasło(minimum 8 znaków)."></i>
        <?php
        if (isset($_SESSION['errorWrongPasswordSize']))echo $_SESSION['errorWrongPasswordSize'];
        ?>
        <br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="confirmPassword" name="confirmPassword" placeholder="Powtórz hasło" required minlength="8" maxlength="255">
        <i class="icon-search help" title="Wprowadź hasło ponownie(minimum 8 znaków, podane hasła muszą się zgadzać)."></i>
       <?php
        if (isset($_SESSION['errorWrongConfirmPasswordSize']))echo $_SESSION['errorWrongConfirmPasswordSize'];
        ?>
        <br>
        <input type="tel" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="phone" name="phone" pattern="[0-9]{9}" placeholder="Telefon" minlength="9" maxlength="9" required>
        <i class="icon-search help" title="Wprowadź numer telefonu jako 9 kolejnych cyfr (przykład 123456789)."></i>
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