<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=4" />
</head>

<div id ="formContainer">

    <form action="<?php echo URLROOT.'/publishers/publisherFormHandler/edycja/'. $nazwa?>" method="post">

        <input type="text" id="publisher" name="publisher" placeholder="Nazwa wydawnictwa" pattern="[A-Za-z.,-]+" value=<?php echo $nazwa?> minlength="1" maxlength="255" required>
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
        <input type="submit" value="Zmień" id="submit">
    </form>
</div>