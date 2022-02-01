<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=101" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css?v=101" />
</head>
<?php returnRedirect("books"); ?>
<div id="formContainer" class="wideForm">
  <form action="<?php echo URLROOT . '/books/BookEditFormHandler/'.$currentBook->id_ksiazki ?>" method="post">
    <input type="text" class="wide" <?php if (isset($_SESSION['emptyTitle']) || isset($_SESSION['errorTitleInvalidData'])) echo "class='error'"; ?> id="title" name="title" placeholder="tytuł" value="<?php echo $currentBook->tytul ?> "minlength="1" maxlength="255" required>
    <i class="icon-search help" title="Wprowadź tytuł utworu."></i>
    <br>
    <select id="author" name="author[]" multiple class="wide" required>
      <?php foreach ($authors as $key => $author) {
        echo '<option value="' . $author->id_autora. '">' . $author->imie.' '.$author->nazwisko.'</option>';
      }
      ?>
    </select>
    <i class="icon-search help" title="Wybierz autora. W przypadku wielu zaznacz przytrzymując klawisz ctrl."></i>
    <br>
    <select id="category" name="category" class="wide" required>
      <?php foreach ($categories as $key => $category) {
        echo '<option value="' . $category->id_kategorii. '">' . $category->nazwa . '</option>';
      }
      ?>
    </select>
    <i class="icon-search help" title="Wybierz odpowiednią kategorię."></i>
    <br>
    <select id="publisher" name="publisher" class="wide" required>
      <?php foreach ($publishers as $key => $publisher) {
        echo '<option value="' . $publisher->id_wydawnictwa . '">' . $publisher->nazwa . '</option>';
      }
      ?>
    </select>
    <i class="icon-search help" title="Wybierz odpowiednie wydawnictwo."></i>
    <br>
    <textarea name="description" id="description" cols="30" rows="5" placeholder="opis" class="wide" >

    <?php echo $currentBook->opis ?>

    </textarea>
    <i class="icon-search help" title="Wprowadź opis utworu."></i>
    <br>
    <input type="submit" value="Dalej" id="submit" class="wide" >
  </form>
</div>