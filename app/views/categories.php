<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=10" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=10" />


</head>
<?php include('returns/returnConfiguration.php'); ?>
<a class="button right" href="<?php echo URLROOT . "/categories/addCategory" ?>">
    <i class="icon-plus"></i>
    Dodaj
</a>
<div id="container">


    <?php if (isset($_SESSION['errorDelete'])) {
        echo $_SESSION['errorDelete'] . "<br>";
        unset($_SESSION['errorDelete']);
    } ?>





    <?php if (count($categories) > 0) {
    ?>
        <table>
            <thead>
                <th>lp.</th>
                <th>nazwa kategorii</th>
                <th>edycja</th>
                <th>usuwanie</th>
            </thead>
            <tbody>
                <?php
                foreach ($categories as $index => $category) {
                ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $category->nazwa; ?></td>
                        <td>
                            <a title="edytuj" href="<?php echo URLROOT . "/categories/editCategory?nazwa=" . $category->nazwa ?>">
                                <i class="icon-cog"></i>
                            </a>
                        </td>
                        <td>
                            <a title="usuń" href="<?php echo URLROOT . "/categories/deleteCategory/" . $category->id_kategorii ?>">
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
        <p>Nie znaleziono kategorii</p>
    <?php
    }
    ?>
</div>