<link rel="stylesheet" href="<?php echo URLROOT;?>/css/logreg.css" /></head>
<body>
<div class ="logreg">
    <form  action="<?php echo URLROOT."/register/registerUser"?>" method="post">
        <input type="email" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="email" name="email" placeholder="E-mail" required><br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="password" name="password" placeholder="Hasło" required><br>
        <input type="password" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="confirmPassword" name="confirmPassword" placeholder="Powtórz hasło" required><br>
        <input type="text" <?php if(isset($_SESSION['errorIncompleteRegisterData'])||isset($_SESSION['errorDataAlreadyExists']))echo "class='error'";?> id="phone" name="phone" placeholder="Telefon" required><br>
        <input type="submit" value="Zarejestruj">
    </form>
    <?php
    if (isset($_SESSION['errorIncompleteRegisterData']))echo $_SESSION['errorIncompleteRegisterData'];
    if (isset($_SESSION['errorDataAlreadyExists']))echo $_SESSION['errorDataAlreadyExists'];
    ?>
    Jeśli masz już założone konto<br>
    <a href="<?php echo URLROOT."/login"?>">kliknij tutaj</a>
</div>    
    
</body>