<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=2" />
</head>
<div id="container">
    <a class="tile" id="catalog" href="<?php echo URLROOT."/books"?>">
        <i class="icon-book"></i>
        <br>
        Katalog
    </a>
    <a class="tile" id="logout" href="<?php echo URLROOT."/readerProfile/logout"?>">
        <i class="icon-logout"></i>
        <br>
        Wyloguj
    </a>
    <div style="clear: both;"></div>
    <a class="tile" id="myborrows" href="<?php echo URLROOT . "/readerProfile/myBorrows"?>">
        <i class="icon-list"></i>
        <br>
        Moje wypożyczenia
    </a>
    <a class="tile" id="mydata" href="<?php echo URLROOT."/readerProfile/changeData"?>">
        <i class="icon-pencil"></i>
        <br>        
        Moje dane
</a>
<div style="clear: both;"></div>
</div>