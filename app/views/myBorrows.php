<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("readerProfile");?>
<div id="borrowsTable">
    <div id = "info">
        Twój aktualny limit wypożyczeń wynosi: <?php echo $_SESSION['userData']->limit_ksiazek;?>
    </div>
<?php if(count($borrows)>0){
    ?>
    <table>
        <thead>
            <th>lp.</th>
            <th>nr egzemplarza</th>
            <th>tytuł</th>
            <th>data wypożyczenia</th>
            <th>prolongata</th>
            <th> ostateczny termin oddania </th>
            <th>data oddania</th>
        </thead>
        <tbody>
            <?php
            foreach ($borrows as $index => $borrow) {
            ?>
                <tr>
                    <td><?php echo $index+1; ?></td>
                    <td><?php echo $borrow->id_egzemplarza ?></td>
                    <td><?php echo $borrow->tytul ?></td>
                    <td><?php echo $borrow->data_wypozyczenia; ?></td>
                    <td><?php if ($borrow->prolongowane==true) echo "wykorzystano"; 
                    else if ($borrow->data_oddania!=null) echo "-";
                    else echo '<a id="pinkHref" href="'. URLROOT .'/readerProfile/prolongBook/?borrowId='.$borrow->id_wypozyczenia.'">prolonguj</a>';?></td>
                   <td><?php 
                    if($borrow->data_oddania==null)
                    {
                        if ($borrow->prolongowane==true) echo $borrow->termin_ost_prol; else echo $borrow->termin_ost_nieprol; 
                    }
                    else echo "oddano";
                    ?></td>
                    <td><?php if($borrow->data_oddania!=null)echo $borrow->data_oddania; else echo "-"; ?></td>                    
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