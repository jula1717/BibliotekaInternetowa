<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("workerProfile"); ?>
<?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
echo '<a class="button right" href="'.URLROOT.'/books/addBook"><i class="icon-plus"></i>Dodaj</a>';?>
<div id="container">

<?php if (isset($_SESSION['errorDelete'])) {
        echo $_SESSION['errorDelete'] . "<br>";
        unset($_SESSION['errorDelete']);
    } ?>

    <?php if (count($books) > 0) {
    ?>
    <div class="flex-two">
    <input type="text" class="wide" id="booksearch" name="booksearch" placeholder="wyszukaj">
    <input type="submit" value="Wyszukaj" onclick="wyszukaj()">
<script>
    function wyszukaj() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("booksearch");
  filter = input.value.toUpperCase();
  table = document.querySelector("#book-catalog tbody");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
console.log(tr[i].innerText);
txtValue = tr[i].textContent || tr[i].innerText;
txtValue = txtValue.replace(/[\s]+/g, ' ').toUpperCase();

var filterA = filter.split(' ');
console.log(filterA);
tr[i].style.display = "";//pokaz
for(j=0;j<filterA.length;j++)
{
console.log(txtValue);
if (txtValue.indexOf(filterA[j]) > -1) {
        //tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }

  }
}
}
</script>

    </div>
       <table id="book-catalog">
            <thead>
                <th>lp.</th>
                <th>tytuł</th>
                <th>autor</th>
                <th>kategoria</th>
                <th>wydawnictwo</th>
                <th>szczegóły</th>
                <?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
                echo '<th>edycja</th>';
                ?>
                <?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
                echo ' <th>usuwanie</th>';
                ?>
            </thead>
            <tbody>
                <?php
                foreach ($books as $index => $book) {
                ?>
                    <tr>
                        
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $book->tytul; ?></td>
                        <td><?php echo $book->autor?></td>
                        <td><?php echo $book->kategoria; ?></td>
                        <td><?php echo $book->wydawnictwo; ?></td>
                        <td>
                            <a title="podgląd" href="<?php echo URLROOT . "/books/copies/" . $book->id_ksiazki?>">
                            <i class="icon-info"></i>
                            </a>
                        </td>
                        <?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
                           echo ' <td><a title="edytuj" href="'.URLROOT.'/books/editBook/'.$book->id_ksiazki.'"><i class="icon-cog"></i></a></td>'?>
                        <?php if($_SESSION['userData']->typ_konta=="administrator"||$_SESSION['userData']->typ_konta=="pracownik") 
                           echo ' <td><a title="usuń" href="'.URLROOT.'/books/deleteBook/'.$book->id_ksiazki.'"><i class="icon-trash-1"></i></a></td>'?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <p>Nie znaleziono książek</p>
    <?php
    }
    ?>
</div>