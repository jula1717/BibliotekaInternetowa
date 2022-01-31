<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css??v=0.0.3" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css??v=0.0.1" />
</head>
<?php returnRedirect("books"); ?>
<a class="button right" href="<?php echo URLROOT . "/books/addCopy/".$book->id_ksiazki ?>">
    <i class="icon-plus"></i>
    Dodaj
</a>
<div id="container">
<?php if (isset($_SESSION['errorDelete'])) {
        echo $_SESSION['errorDelete'] . "<br>";
        unset($_SESSION['errorDelete']);
    } ?>
    <?php echo $book->tytul.' '.$book->autor.' '.$book->kategoria.' '.$book->wydawnictwo.' '.$book->opis;
    ?>
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