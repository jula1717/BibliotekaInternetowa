<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=4.2" />
</head>
<?php returnRedirect("books","copies",$id_ksiazki);?>
<div id ="formContainer">
    <form action="<?php echo URLROOT."/books/CopyAddFormHandler/".$id_ksiazki?>" method="post">
    <input type="number" name="publicationYear" id="publicationYear" min="1900" max="2022" step="1" value="2022" required/>
        <input type="submit" value="Dodaj" id="submit" >
    </form>
</div>