<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css??v=0.0.3" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css??v=101" />
</head>
<?php returnRedirect("books"); ?>
<?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
echo '<a class="button right" href="'.URLROOT.'/books/addCopy/'.$book->id_ksiazki.'"><i class="icon-plus"></i>Dodaj</a>';?>


<div id="container">
<?php if (isset($_SESSION['errorDelete'])) {
        echo $_SESSION['errorDelete'] . "<br>";
        unset($_SESSION['errorDelete']);
    } ?>
    <div id="info" class="smallFont">
    <?php 
    echo '<h1>'. $book->tytul.'</h1> <b>Autor:</b> '.$book->autor.'</br><b>Kategoria:</b> '.$book->kategoria.'</br><b>Wydawnictwo:</b> '.$book->wydawnictwo.'<br><b>Opis:</b> '.nl2br($book->opis,false);
    ?>
    </div>
    <?php if (count($copies) > 0) {
    ?>
        <table>
            <thead>
                <th>lp.</th>
                <th>id egzemplarza</th>
                <th>rok wydania</th>
                <th>wypożycz</th>
                <th>usuwanie</th>
            </thead>
            <tbody>
                <?php
                foreach ($copies as $index => $copy) {
                ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $copy->id_egzemplarza; ?></td>
                        <td><?php echo $copy->rok_wydania; ?></td>
                        <td>
                            <?php if($copy->wypozyczona!="0")
                         echo "wypozyczona"; 
                         else
                         echo '<a id="pinkHref" title="wypożycz" href="'.URLROOT . '/books/borrowCopy/' .$book->id_ksiazki.'/'. $copy->id_egzemplarza.'/'.'">wypożycz</a>';?>
                         </td>                  
                        <td>
                            <a title="usuń" href="<?php echo URLROOT . "/books/deleteCopy/" . $copy->id_egzemplarza.'/'.$book->id_ksiazki?>">
                                <i class="icon-trash-1"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <p>Nie znaleziono egzemplarzy</p>
    <?php
    }
    ?>
</div>