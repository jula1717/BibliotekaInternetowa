<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/configuration.css?v=1" />
</head>
<div id="container">
    <a class="tile" id="categories" href="<?php echo URLROOT . "/categories"?>">
        <i class="icon-list"></i>
        <br>
        Kategorie
    </a>
    <a class="tile" id="authors" href="#">
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