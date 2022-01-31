<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/fontello/fontello.css?v=2" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/workerProfile.css?v=4.1" />
</head>
<?php returnRedirect("books");?>
<div id ="formContainer" class="wideForm">
    <form action="<?php echo URLROOT."/books/BookAddFormHandler"?>" method="post">
    <input type="text" class="wide" <?php if(isset($_SESSION['emptyTitle'])||isset($_SESSION['errorTitleInvalidData']))echo "class='error'";?> id="title" name="title" placeholder="Tytuł" minlength="1" maxlength="255" required>
    <input type="text" class="wide" <?php if(isset($_SESSION['emptyFirstnameField'])||isset($_SESSION['errorFirstnameInvalidData']))echo "class='error'";?> id="authorFirstname" name="authorFirstname" placeholder="Imię autora" pattern="[A-Z][a-z-.]+" minlength="1" maxlength="255" required>
        <?php
        if (isset($_SESSION['errorFirstnameInvalidData'])) echo $_SESSION['errorFirstnameInvalidData'];
        ?>
        <br>
        <input type="text" class="wide" <?php if(isset($_SESSION['emptyLastnameField'])||isset($_SESSION['errorLastnameInvalidData']))echo "class='error'";?> id="authorLastname" name="authorLastname" placeholder="Nazwisko autora" pattern="[A-Z][a-z-.]+" minlength="1" maxlength="255" required>
        <?php
        if (isset($_SESSION['emptyField']))echo $_SESSION['emptyField'];
        if (isset($_SESSION['errorLastnameInvalidData'])) echo $_SESSION['errorLastnameInvalidData'];
        ?>
        <br>
  <select id="category" name="category" class="wide">
      <?php foreach ($categories as $key => $category) {
        echo '<option value="'.$category->nazwa.'">'.$category->nazwa.'</option>';
      }
     ?>
  </select>
  <select id="publisher" name="publisher" class="wide">
      <?php foreach ($publishers as $key => $publisher) {
        echo '<option value="'.$publisher->nazwa.'">'.$publisher->nazwa.'</option>';
      }
     ?>
  </select>

        <input type="submit" value="Dodaj" id="submit" class="wide">
    </form>
</div>