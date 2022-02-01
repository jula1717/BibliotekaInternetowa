<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("publishers");?>
<div id ="formContainer">
    <form action="<?php echo URLROOT."/publishers/publisherFormHandler/dodanie"?>" method="post">

        <input type="text" id="publisher" name="publisher" placeholder="Nazwa wydawnictwa" pattern="^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+((( |, |-)[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+){0,255})" minlength="1" maxlength="255" required>
        <i class="icon-search help" title="Wprowadź nazwę wydawnictwa."></i>
        <?php
        if (isset($_SESSION['errorEmptyField']))
        {
            echo $_SESSION['errorEmptyField'];
            unset($_SESSION['errorEmptyField']);
        }
        if (isset($_SESSION['errorInvalidData'])) 
        {
            echo $_SESSION['errorInvalidData'];
            unset($_SESSION['errorInvalidData']);
        }
        if (isset($_SESSION['errorSamePublisher']))
        {
            echo $_SESSION['errorSamePublisher'];
            unset($_SESSION['errorInvalidData']);
        }
        ?>
        <br>
        <input type="submit" value="Dodaj" id="submit">
    </form>
</div>