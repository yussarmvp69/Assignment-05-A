<?php
$deleteCommand = filter_input(INPUT_GET, 'com');
if (isset($deleteCommand) && $deleteCommand == 'del') {
    $genreId = filter_input(INPUT_GET, 'gid');
    $result = deleteGenreFromDb($genreId);
    if ($result) {
        echo '<div>Data successfully deleted</div>';
    } else {
        echo '<div>Failed to delete genre</div>';
    }
}
$submitPressed = filter_input(INPUT_POST, 'btnSave');
if (isset($submitPressed)) {
    $name = filter_input(INPUT_POST, 'txtName');
    $query = "UPDATE genre SET name = ? WHERE id = ?";
    if (trim($name) == ' ') {
        echo '<div> Please provide with valid name</div>';
    } else {
        $result = addNewGenre($name);
        if ($result) {
            echo '<div> Data Successfully added</div>';
        } else {
            echo '<div> Failed to add Data</div>';
        }
    }
}
?>

<form action="" method="post">
    <label for="txtName">Genre Name</label>
    <input class="form-control me-2" type="text" maxlength="45" placeholder="Book Name" required autofocus name="txtName" id="txtName">
    <button class="btn btn-outline-success" type="submit" name="btnSave">Submit</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $link = createMySQLConnection();
        $query = 'SELECT * FROM genre';
        $result = $link->query($query);
        foreach ($result as $genre) {
            echo '<tr>';
            echo '<td>' . $genre['id'] . '</td>';
            echo '<td>' . $genre['name'] . '</td>';
            echo '<td>
            <button onclick="editGenre(' . $genre["id"] . ')">update data</button>
            <button onclick="deleteGenre(' . $genre["id"] . ')">delete data</button>  
            </td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<script src="js/genre.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    })
</script>