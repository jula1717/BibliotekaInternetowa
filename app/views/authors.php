<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />


</head>

<?php returnRedirect("configuration");?>
<a class="button right" href="<?php echo URLROOT . "/Authors/addAuthor" ?>">
    <i class="icon-plus"></i>
    Dodaj
</a>
<div id="container">


    <?php if (isset($_SESSION['errorDelete'])) {
        echo $_SESSION['errorDelete'] . "<br>";
        unset($_SESSION['errorDelete']);
    } ?>

    <?php if (count($authors) > 0) {
    ?>
        <table>
            <thead>
                <th>lp.</th>
                <th>imię</th>
                <th>nazwisko</th>
                <th>edycja</th>
                <th>usuwanie</th>
            </thead>
            <tbody>
                <?php
                foreach ($authors as $index => $author) {
                ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $author->imie; ?></td>
                        <td><?php echo $author->nazwisko; ?></td>
                        <td>
                            <a title="edytuj" href="<?php echo URLROOT . "/authors/editAuthor?imie=" . $author->imie . "&nazwisko=" . $author->nazwisko . "&id_autora=" . $author->id_autora ?>">
                                <i class="icon-cog"></i>
                            </a>
                        </td>
                        <td>
                            <a title="usuń" href="<?php echo URLROOT . "/authors/deleteAuthor/" . $author->id_autora ?>">
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
        <p>Nie znaleziono autorów</p>
    <?php
    }
    ?>
</div>