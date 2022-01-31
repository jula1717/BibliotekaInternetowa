<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css??v=0.0.1" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css??v=0.0.8" />
</head>
<?php returnRedirect("readers");?>
<div id="borrowsTable">
<?php if(count($borrows)>0){
    ?>
    <table>
        <thead>
            <th>lp.</th>
            <th>e-mail czytelnika</th>
            <th>nr egzemplarza</th>
            <th>tytuł</th>
            <th>data wypożyczenia</th>
            <th>prolongowane</th>
            <th> ostateczny termin oddania </th>
            <th>data oddania</th>
            <th>e-mail pracownika<br> odbierającego książkę</th>
        </thead>
        <tbody>
            <?php
            foreach ($borrows as $index => $borrow) {
            ?>
                <tr>
                    <td><?php echo $index+1; ?></td>
                    <td><?php echo $borrow->czyt_email?></td>
                    <td><?php echo $borrow->id_egzemplarza ?></td>
                    <td><?php echo $borrow->tytul ?></td>
                    <td><?php echo $borrow->data_wypozyczenia; ?></td>
                    <td><?php if ($borrow->prolongowane==true) echo "tak"; else echo "nie"; ?></td>
                    <td><?php 
                    if($borrow->data_oddania==null)
                    {
                        if ($borrow->prolongowane==true) echo $borrow->termin_ost_prol; else echo $borrow->termin_ost_nieprol; 
                    }
                    else echo "oddano";
                    ?></td>
                    <td><?php if($borrow->data_oddania!=null)echo $borrow->data_oddania; else echo "-"; ?></td>
                    <td><?php if($borrow->data_oddania!=null) echo $borrow->prac_email; else
                    echo '<a id="pinkHref" href="'. URLROOT .'/readers/returnBook/?borrowId='.$borrow->id_wypozyczenia.'&readerId='.$_GET['readerId'].'">Przyjmij zwrot</a>';?></td>
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
<p>Nie znaleziono wypożyczeń dla tego użytkownika</p>
<?php
}
?>
</div>