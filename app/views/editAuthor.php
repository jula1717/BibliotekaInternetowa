<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=4" />
</head>
<?php returnRedirect("authors");?>
<div id ="formContainer">

    <form action="<?php echo URLROOT.'/authors/authorFormHandler/edycja/'. $imie . '/' . $nazwisko . '/'. $id_autora ?>" method="post">

    <input type="text" <?php if(isset($_SESSION['emptyFirstnameField'])||isset($_SESSION['errorFirstnameInvalidData']))echo "class='error'";?> id="authorFirstname" name="authorFirstname" placeholder="Imię autora" pattern="[A-Z][a-z-.]+" value=<?php echo $imie?> minlength="1" maxlength="255" required>
        <?php
        if (isset($_SESSION['emptyFirstnameField']))echo $_SESSION['emptyFirstnameField'];
        if (isset($_SESSION['errorFirstnameInvalidData'])) echo $_SESSION['errorFirstnameInvalidData'];
        ?>
        <br>
        <input type="text" <?php if(isset($_SESSION['emptyLastnameField'])||isset($_SESSION['errorLastnameInvalidData']))echo "class='error'";?> id="authorLastname" name="authorLastname" placeholder="Nazwisko autora" pattern="[A-Z][a-z-.]+" value=<?php echo $nazwisko?> minlength="1" maxlength="255" required>
        <?php
        if (isset($_SESSION['emptyLastnameField']))echo $_SESSION['emptyLastnameField'];
        if (isset($_SESSION['errorLastnameInvalidData'])) echo $_SESSION['errorLastnameInvalidData'];
        if (isset($_SESSION['errorSameAuthor'])) echo $_SESSION['errorSameAuthor'];
        ?>
        <br>
        <input type="submit" value="Zmień" id="submit">
    </form>
</div>