<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("books","copies",$id_ksiazki);?>
<div id ="formContainer">
    <form action="<?php echo URLROOT."/books/CopyAddFormHandler/".$id_ksiazki?>" method="post">
    <input type="number" name="publicationYear" id="publicationYear" min="1900" max="2022" step="1" value="2022" required/>
    <i class="icon-search help" title="Wybierz rok wydania dla dodawanego egzemplarza."></i>   
    <input type="submit" value="Dodaj" id="submit" >
    </form>
</div>