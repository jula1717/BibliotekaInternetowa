<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css??v=0.0.1" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css??v=0.0.1" />


</head>
<?php returnRedirect("configuration");?>
<a class="button right" href="<?php echo URLROOT . "/publishers/addPublisher" ?>">
    <i class="icon-plus"></i>
    Dodaj
</a>
<div id="container">


    <?php if (isset($_SESSION['errorDelete'])) {
        echo $_SESSION['errorDelete'] . "<br>";
        unset($_SESSION['errorDelete']);
    } ?>





    <?php if (count($publishers) > 0) {
    ?>
        <table>
            <thead>
                <th>lp.</th>
                <th>nazwa wydawnictwa</th>
                <th>edycja</th>
                <th>usuwanie</th>
            </thead>
            <tbody>
                <?php
                foreach ($publishers as $index => $publisher) {
                ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $publisher->nazwa; ?></td>
                        <td>
                            <a title="edytuj" href="<?php echo URLROOT . "/publishers/editPublisher?nazwa=" . $publisher->nazwa ?>">
                                <i class="icon-cog"></i>
                            </a>
                        </td>
                        <td>
                            <a title="usuń" href="<?php echo URLROOT . "/publishers/deletePublisher/" . $publisher->id_wydawnictwa ?>">
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
        <p>Nie znaleziono wydawnictw</p>
    <?php
    }
    ?>
</div>