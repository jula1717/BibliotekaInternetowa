<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css??v=0.0.1" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css??v=0.0.1" />


</head>
<?php returnRedirect("books","copies",$id_ksiazki);?>

<div id="container">
<?php
        if (isset($_SESSION['limitError'])) echo $_SESSION['limitError'];
        ?>
<?php if(count($readers)>0){
    ?>
    <table>
        <thead>
            <th>lp.</th>
            <th>e-mail czytelnika</th>
        </thead>
        <tbody>
            <?php
            foreach ($readers as $index => $reader) {
            ?>
                <tr>
                    <td><?php echo $index+1; ?></td>
                    <td><?php echo '<a href='. URLROOT .'/Books/tryToBorrowCopy/' . $reader->id_uzytkownika .'/'.$id_ksiazki.'/'.$id_egzemplarza. '>'. $reader->email . '</a>';?></td>
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