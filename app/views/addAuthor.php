<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=4" />
</head>

<div id ="formContainer">
    <form action="<?php echo URLROOT."/authors/authorFormHandler/dodanie"?>" method="post">

        <input type="text" <?php if(isset($_SESSION['emptyFirstnameField'])||isset($_SESSION['errorFirstnameInvalidData']))echo "class='error'";?> id="authorFirstname" name="authorFirstname" placeholder="Imię autora" pattern="[A-Z][a-z-.]+" minlength="1" maxlength="255" required>
        <?php
        if (isset($_SESSION['errorFirstnameInvalidData'])) echo $_SESSION['errorFirstnameInvalidData'];
        ?>
        <br>
        <input type="text" <?php if(isset($_SESSION['emptyLastnameField'])||isset($_SESSION['errorLastnameInvalidData']))echo "class='error'";?> id="authorLastname" name="authorLastname" placeholder="Nazwisko autora" pattern="[A-Z][a-z-.]+" minlength="1" maxlength="255" required>
        <?php
        if (isset($_SESSION['emptyField']))echo $_SESSION['emptyField'];
        if (isset($_SESSION['errorLastnameInvalidData'])) echo $_SESSION['errorLastnameInvalidData'];
        ?>
        <br>
        <input type="submit" value="Dodaj" id="submit">
    </form>
</div>