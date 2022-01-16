<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=7" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=7" />


</head>
<?php include ('returns/returnWorkerProfile.php'); ?>
<div id="container">

<?php if(count($readers)>0){
    ?>
    <table>
        <thead>
            <th>lp.</th>
            <th>e-mail czytelnika</th>
            <th>telefon</th>
            <th>limit</th>
        </thead>
        <tbody>
            <?php
            foreach ($readers as $index => $reader) {
            ?>
                <tr>
                    <td><?php echo $index+1; ?></td>
                    <td><?php echo '<a href='. URLROOT .'/readers/borrows/?readerId=' . $reader->id_uzytkownika . '>'. $reader->email . '</a>';?></td>
                    <td><?php echo $reader->telefon ?></td>
                    <td><?php echo $reader->limit; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
else
{
?>
<p>Nie znaleziono użytkowników</p>
<?php
}
?>
</div>