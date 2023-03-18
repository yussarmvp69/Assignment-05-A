<?php
include_once 'utility/db_util.php';
include_once 'function/book_function.php';
$deleteCommand = filter_input(INPUT_GET, 'com');
if (isset($deleteCommand) && $deleteCommand == 'del') {
  $genreId = filter_input(INPUT_GET, 'gid');
  $result = deleteBookFromDb($genreId);
  if ($result) {
    echo '<div>Data successfully deleted</div>';
  } else {
    echo '<div>Failed to delete genre</div>';
  }
}
$submitPressed = filter_input(INPUT_POST, 'btnSave');
if (isset($submitPressed)) {
  $isbn = filter_input(INPUT_POST, 'txtIsbn');
  $title = filter_input(INPUT_POST, 'txtName');
  $author = filter_input(INPUT_POST, 'txtAuthor');
  $publisher = filter_input(INPUT_POST, 'txtPublisher');
  $pyear = filter_input(INPUT_POST, 'txtPyear');
  $sinopsis = filter_input(INPUT_POST, 'txtSinopsis');
  $cover = filter_input(INPUT_POST, 'txtCover');
  $genre = filter_input(INPUT_POST, 'txtGenre');
  $query = "INSERT INTO book(isbn,title,author,publisher,publish_year,short_description,cover,genre_id) VALUES(?,?,?,?,?,?,?,?)";
  if (trim($title) == ' ') {
    echo '<div> Please provide with valid name</div>';
  } else {
    $link = new PDO('mysql:host=localhost;dbname=pwl2022', 'root', 'jaeger12');
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->beginTransaction();
    $query = 'INSERT INTO book(isbn,title,author,publisher,publish_year,short_description,cover,genre_id) VALUES(?,?,?,?,?,?,?,?)';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $isbn);
    $stmt->bindParam(2, $title);
    $stmt->bindParam(3, $author);
    $stmt->bindParam(4, $publisher);
    $stmt->bindParam(5, $pyear);
    $stmt->bindParam(6, $sinopsis);
    $stmt->bindParam(7, $cover);
    $stmt->bindParam(8, $genre);
    if ($stmt->execute()) {
      $link->commit();
    } else {
      $link->rollBack();
    }
    $link = null;
  }
}
?>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <form action="" method="post">
      <label for="txtIsbn">isbn</label>
      <input type="text" maxlength="45" placeholder="isbn" required autofocus name="txtIsbn" id="txtIsbn">
      <br>
      <label for="txtName">name</label>
      <input type="text" maxlength="45" placeholder="name" required autofocus name="txtName" id="txtName">
      <br>
      <label for="txtAuthor">author</label>
      <input type="text" maxlength="45" placeholder="authorauthor" required autofocus name="txtAuthor" id="txtAuthor">
      <br>
      <label for="txtPublisher">publisher</label>
      <input type="text" maxlength="45" placeholder="publisher" required autofocus name="txtPublisher" id="txtPublisher">
      <br>
      <label for="txtPyear">publisher_year</label>
      <input type="text" maxlength="45" placeholder="publisher_year" required autofocus name="txtPyear" id="txtPyear">
      <br>
      <label for="txtSinopsis">short_description</label>
      <input type="text" maxlength="45" placeholder="short_description" required autofocus name="txtSinopsis" id="txtSinopsis">
      <br>
      <label for="txtCover">cover</label>
      <input type="text" maxlength="45" placeholder="cover" required autofocus name="txtCover" id="txtCover">
      <br>
      <label for="txtGenre">genre_id</label>
      <input type="text" maxlength="45" placeholder="genre_id" required autofocus name="txtGenre" id="txtGenre">

      <input type="submit" value="Save Data" name="btnSave">
    </form>
  </div>
  <!-- <div class="row">
  <label for="">GENRE</label>
  <div class="col-sm-18">
    <select name="form-control" id="comboGenre" name="comboGenre">
      <option value="">--SELECT YOUR GENRE--</option>
      <?php
      $link = new PDO('mysql:host=localhost;dbname=pwl2022', 'root', 'jaeger12');
      $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
      $query
      ?>

    </select>

  </div>
  </div> -->


</nav>
<table class="table" id="myTable">
  <thead>
    <tr>
      <th>isbn</th>
      <th>name</th>
      <th>author</th>
      <th>publisher</th>
      <th>publish_year</th>
      <th>short_description</th>
      <th>cover</th>
      <th>genre id</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $link = createMySQLConnection();
    $query = 'SELECT * FROM book';
    $result = $link->query($query);
    foreach ($result as $book) {
      echo '<tr>';
      echo '<td>' . $book['isbn'] . '</td>';
      echo '<td>' . $book['title'] . '</td>';
      echo '<td>' . $book['author'] . '</td>';
      echo '<td>' . $book['publisher'] . '</td>';
      echo '<td>' . $book['publish_year'] . '</td>';
      echo '<td>' . $book['short_description'] . '</td>';
      echo '<td>' . $book['cover'] . '</td>';
      echo '<td>' . $book['genre_id'] . '</td>';
      echo '<td>
      <button onclick="editGenre(/' . $book["isbn"] . '/)">update data</button>
      <button onclick="deleteGenre(/' . $book["isbn"] . '/)">delete data</button>  
      </td>';
      echo '</tr>';
    }

    ?>
  </tbody>
</table>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  })
</script>