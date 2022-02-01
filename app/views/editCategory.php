<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("categories");?>
<div id ="formContainer">
    <form action="<?php echo URLROOT.'/categories/categoryFormHandler/edycja/';?>" method="post" accept-charset="UTF-8">
        <input type="hidden" name="staraNazwa" value="<?php echo $nazwa;?>">
        <input type="text" <?php if(isset($_SESSION['emptyField'])||isset($_SESSION['errorInvalidData']))echo "class='error'";?> id="category" name="category" placeholder="Nazwa kategorii" pattern="^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+((( |, |-)[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]+){0,255})" value=<?php echo $nazwa?> minlength="3" maxlength="255" required>
        <i class="icon-search help" title="Wprowadź nazwę kategorii (minimum 3 znaki)."></i>
        <?php
        if (isset($_SESSION['errorEmptyField']))echo $_SESSION['errorEmptyField'];
        if (isset($_SESSION['errorInvalidData'])) echo $_SESSION['errorInvalidData'];
        if (isset($_SESSION['errorSameCategory']))echo $_SESSION['errorSameCategory'];
        ?>
        <br>
        <input type="submit" value="Zmień" id="submit">
    </form>
</div>