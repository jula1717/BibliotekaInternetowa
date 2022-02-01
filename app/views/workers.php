<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />


</head>
<?php returnRedirect("configuration");?>
<a class="button right" href="<?php echo URLROOT . "/Workers/addWorker" ?>">
    <i class="icon-plus"></i>
    Dodaj
</a>
<div id="workersContainer">

    <?php if (count($workers) > 0) {
    ?>
        <div id="workersTable">
            <table>
                <thead>
                    <th>lp.</th>
                    <th>e-mail czytelnika</th>
                    <th>typ konta</th>
                    <th>telefon</th>
                    <th>status</th>
                    <th>edycja</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($workers as $index => $worker) {
                    ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $worker->email; ?></td>
                            <td><?php echo $worker->typ_konta; ?></td>
                            <td><?php echo $worker->telefon; ?></td>
                            <td><?php echo '<a id="pinkHref" href="'. URLROOT .'/workers/changeStatus/'.$worker->id_uzytkownika.'/'.$worker->status.'">'.$worker->status.'</a>';?></td>
                            <td>
                            <a title="edytuj" href="<?php echo URLROOT . "/workers/editWorker/?workerId=" . $worker->id_uzytkownika?>">
                                <i class="icon-cog"></i>
                            </a>
                        </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
    ?>
        <p>Nie znaleziono pracowników</p>
    <?php
    }
    ?>
</div>