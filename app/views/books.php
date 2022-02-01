<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("workerProfile"); ?>
<?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
echo '<a class="button right" href="'.URLROOT.'/books/addBook"><i class="icon-plus"></i>Dodaj</a>';?>
<div id="container">

<?php if (isset($_SESSION['errorDelete'])) {
        echo $_SESSION['errorDelete'] . "<br>";
        unset($_SESSION['errorDelete']);
    } ?>

    <?php if (count($books) > 0) {
    ?>
        <table>
            <thead>
                <th>lp.</th>
                <th>tytuł</th>
                <th>autor</th>
                <th>kategoria</th>
                <th>wydawnictwo</th>
                <th>szczegóły</th>
                <?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
                echo '<th>edycja</th>';
                ?>
                <?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
                echo ' <th>usuwanie</th>';
                ?>
            </thead>
            <tbody>
                <?php
                foreach ($books as $index => $book) {
                ?>
                    <tr>
                        
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $book->tytul; ?></td>
                        <td><?php echo $book->autor?></td>
                        <td><?php echo $book->kategoria; ?></td>
                        <td><?php echo $book->wydawnictwo; ?></td>
                        <td>
                            <a title="podgląd" href="<?php echo URLROOT . "/books/copies/" . $book->id_ksiazki?>">
                            <i class="icon-info"></i>
                            </a>
                        </td>
                        <?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
                           echo ' <td><a title="edytuj" href="'.URLROOT.'/books/editBook/'.$book->id_ksiazki.'"><i class="icon-cog"></i></a></td>'?>
                        <?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
                           echo ' <td><a title="usuń" href="'.URLROOT.'/books/deleteBook/'.$book->id_ksiazki.'"><i class="icon-trash-1"></i></a></td>'?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <p>Nie znaleziono książek</p>
    <?php
    }
    ?>
</div>