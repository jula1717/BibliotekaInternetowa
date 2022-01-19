<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=11" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
</head>
<?php returnRedirect("workers");?>
<div id="formcontainer" class="wfc">
    <form  action="<?php echo URLROOT."/workers/workerAddFormHandler"?>" method="post">
        <input type="email" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="workerAdd" name="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" maxlength="255" required>
        <?php
        if (isset($_SESSION['errorWrongEmailSize']))echo $_SESSION['errorWrongEmailSize'];
        ?>
        <br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="workerAdd" name="password" placeholder="Hasło" minlength="8" maxlength="255" required> 
        <?php
        if (isset($_SESSION['errorWrongPasswordSize']))echo $_SESSION['errorWrongPasswordSize'];
        ?>
        <br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="workerAdd" name="confirmPassword" placeholder="Powtórz hasło" required minlength="8" maxlength="255">
        <?php
        if (isset($_SESSION['errorWrongConfirmPasswordSize']))echo $_SESSION['errorWrongConfirmPasswordSize'];
        ?>
        <br>
        <input type="tel" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="workerAdd" name="phone" pattern="[0-9]{9}" placeholder="Telefon" minlength="9" maxlength="9" required>
        <?php
        if (isset($_SESSION['errorWrongPhoneSize']))echo $_SESSION['errorWrongPhoneSize'];
        ?>
        <br>
        <input type="submit" value="Dodaj" id="submit">
    </form>
    <?php
    if (isset($_SESSION['errorIncompleteRegisterData']))echo $_SESSION['errorIncompleteRegisterData'];
    if (isset($_SESSION['errorDataAlreadyExists']))echo $_SESSION['errorDataAlreadyExists'];
    ?>
</div>    
    
</body>