<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("authors");?>
<div id ="formContainer">

    <form action="<?php echo URLROOT.'/authors/authorFormHandler/edycja/'. $id_autora ?>" method="post">
    <input type="hidden" name="old_authorFirstname" value="<?php echo $imie;?>">
    <input type="hidden" name="old_authorLastname" value="<?php echo $nazwisko;?>">


    <input type="text" <?php if(isset($_SESSION['emptyFirstnameField'])||isset($_SESSION['errorFirstnameInvalidData']))echo "class='error'";?> id="authorFirstname" name="authorFirstname" placeholder="Imię autora" pattern="^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+((( )[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+){0,10})" value=<?php echo $imie?> minlength="1" maxlength="255" required>
    <i class="icon-search help" title="Wprowadź imię. Powinno się zaczynać z wielkiej litery."></i>
        <?php
        if (isset($_SESSION['emptyFirstnameField']))echo $_SESSION['emptyFirstnameField'];
        if (isset($_SESSION['errorFirstnameInvalidData'])) echo $_SESSION['errorFirstnameInvalidData'];
        ?>
        <br>
        <input type="text" <?php if(isset($_SESSION['emptyLastnameField'])||isset($_SESSION['errorLastnameInvalidData']))echo "class='error'";?> id="authorLastname" name="authorLastname" placeholder="Nazwisko autora" pattern="^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+(((-)[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+){0,255})" value=<?php echo $nazwisko?> minlength="1" maxlength="255" required>
        <i class="icon-search help" title="Wprowadź nazwisko. Powinno się zaczynać z wielkiej litery. Człony oddziel myślnikiem."></i>
        <?php
        if (isset($_SESSION['emptyLastnameField']))echo $_SESSION['emptyLastnameField'];
        if (isset($_SESSION['errorLastnameInvalidData'])) echo $_SESSION['errorLastnameInvalidData'];
        if (isset($_SESSION['errorSameAuthor'])) echo $_SESSION['errorSameAuthor'];
        ?>
        <br>
        <input type="submit" value="Zmień" id="submit">
    </form>
</div>