<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=4" />
</head>
<?php returnRedirect("categories");?>
<div id ="formContainer">

    <form action="<?php echo URLROOT.'/categories/categoryFormHandler/edycja/'. $nazwa?>" method="post">

        <input type="text" <?php if(isset($_SESSION['emptyField'])||isset($_SESSION['errorInvalidData']))echo "class='error'";?> id="category" name="category" placeholder="Nazwa kategorii" pattern="[a-z.,-]+" value=<?php echo $nazwa?> minlength="3" maxlength="255" required>
        <?php
        if (isset($_SESSION['errorEmptyField']))echo $_SESSION['errorEmptyField'];
        if (isset($_SESSION['errorInvalidData'])) echo $_SESSION['errorInvalidData'];
        if (isset($_SESSION['errorSameCategory']))echo $_SESSION['errorSameCategory'];
        ?>
        <br>
        <input type="submit" value="Zmień" id="submit">
    </form>
</div>