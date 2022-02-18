<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("authors");?>
<div id ="formContainer">
    <form action="<?php echo URLROOT."/authors/authorFormHandler/dodanie"?>" method="post">

        <input type="text" <?php if(isset($_SESSION['emptyFirstnameField'])||isset($_SESSION['errorFirstnameInvalidData']))echo "class='error'";?> id="authorFirstname" name="authorFirstname" placeholder="Imię autora" pattern="^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ']+((( )[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ']+){0,255})" minlength="1" maxlength="255" required>
        <i class="icon-search help" title="Wprowadź imię. Powinno się zaczynać z wielkiej litery."></i>
        <?php
        if (isset($_SESSION['errorFirstnameInvalidData'])) echo $_SESSION['errorFirstnameInvalidData'];
        ?>
        <br>
        <input type="text" <?php if(isset($_SESSION['emptyLastnameField'])||isset($_SESSION['errorLastnameInvalidData']))echo "class='error'";?> id="authorLastname" name="authorLastname" placeholder="Nazwisko autora" pattern="^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ']+(((-)[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ']+){0,255})" minlength="1" maxlength="255" required>
        <i class="icon-search help" title="Wprowadź nazwisko. Powinno się zaczynać z wielkiej litery. Człony oddziel myślnikiem."></i>
        <?php
        if (isset($_SESSION['emptyField']))echo $_SESSION['emptyField'];
        if (isset($_SESSION['errorLastnameInvalidData'])) echo $_SESSION['errorLastnameInvalidData'];
        ?>
        <br>
        <input type="submit" value="Dodaj" id="submit">
    </form>
</div>