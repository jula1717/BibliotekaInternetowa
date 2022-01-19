<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=11" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<body>
<?php returnRedirect("workers");?>
<div id="formcontainer" class="wfc">
    <form  action="<?php echo URLROOT.'/workers/workerEditFormHandler'.'/'.$worker->email.'/'.$worker->telefon.'/'.$worker->id_uzytkownika?>" method="post">
        <input type="email" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="workerAdd" name="email" placeholder="E-mail" value=<?php echo $worker->email;?> pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" maxlength="255" required>
        <?php
        if (isset($_SESSION['errorWrongEmailSize']))echo $_SESSION['errorWrongEmailSize'];
        ?>
        <br>
        <input type="tel" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="workerAdd" name="phone" pattern="[0-9]{9}" placeholder="Telefon" value=<?php echo $worker->telefon;?> minlength="9" maxlength="9" required>
        <?php
        if (isset($_SESSION['errorWrongPhoneSize']))echo $_SESSION['errorWrongPhoneSize'];
        ?>
        <br>
        <input type="submit" value="Zmień" id="submit">
    </form>
    <?php
    if (isset($_SESSION['errorIncompleteRegisterData']))echo $_SESSION['errorIncompleteRegisterData'];
    if (isset($_SESSION['errorDataAlreadyExists']))echo $_SESSION['errorDataAlreadyExists'];
    ?>
</div>    
    
</body>