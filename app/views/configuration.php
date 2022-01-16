<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=7" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=7" />
</head>
<?php include ('returns/returnWorkerProfile.php'); ?>
<div id="container">
    <a class="tile" id="categories" href="<?php echo URLROOT . "/categories"?>">
        <i class="icon-list"></i>
        <br>
        Kategorie
    </a>
    <a class="tile" id="authors" href="<?php echo URLROOT . "/authors"?>">
        <i class="icon-vector-pencil"></i>
        <br>
        Autorzy
    </a>
    <div style="clear: both;"></div>
    <a class="tile" id="publishers" href="<?php echo URLROOT . "/publishers"?>">
        <i class="icon-print"></i>
        <br>
        Wydawnictwa
    </a>
    <?php
    if ($_SESSION['userData']->typ_konta == "administrator") {
        echo '<a class="tile" id="workers" href="#">';
        echo '<i class="icon-person"></i><br>';
        echo "<br>Pracownicy</a>";
    }
    ?>

    <div style="clear: both;"></div>
</div>