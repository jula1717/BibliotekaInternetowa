<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=1" />
</head>
<div id="container">
    <a class="tile" id="readers" href="<?php echo URLROOT."/readers"?>">
        <i class="icon-user"></i>
        <br>
        Czytelnicy
    </a>
    <a class="tile" id="logout" href="<?php echo URLROOT."/workerProfile/logout"?>">
        <i class="icon-logout"></i>
        <br>
        Wyloguj
    </a>
    <div style="clear: both;"></div>
    <a class="tile" id="books" href="<?php echo URLROOT."/books"?>">
        <i class="icon-book"></i>
        <br>
        Książki
    </a>
    <a class="tile" id="settings" href="<?php echo URLROOT."/Configuration"?>">
        <i class="icon-cogs"></i>
        <br>
        Kategorie Autorzy<br>
        Wydawnictwa
        <?php if($_SESSION['userData']->typ_konta=="administrator") echo "<br>Pracownicy"?>
        
</a>
<div style="clear: both;"></div>
</div>