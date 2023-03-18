<?php
$genreId = filter_input(INPUT_GET, 'gid');
if (isset($genreId)) {
    $genre = fetchOneGenreFromDb($genreId);
}

$updatePressed = filter_input(INPUT_POST, 'btnUpdate');
if (isset($updatePressed)) {
    $name = filter_input(INPUT_POST, 'txtName');
    if (trim($name) == '') {
        echo 'Please fill a valid genre name';
    } else {
        $result = updateGenreToDb($genreId, $name);
        if ($result) {
            header('location:index.php?menu=genre');
        } else {
            echo '<div>Failed to update genre</div>';
        }
    }
}
?>
<table>
    <tr>
        <td><label for="txtId">Genre ID</label></td>
        <td><input type="text" maxlength="45" id="txtName" name="txtName" required autofocus placeholder="Genre Id" readonly id="txtId" value="<?php echo $genre['id']; ?>"></td>
    </tr>
    <tr>
        <td><label for="txtId">Nama Genre</label></td>
        <td><input type="text" maxlength="45" id="txtName" name="txtName" required autofocus placeholder="New Genre Name" value="<?php echo $genre['name']; ?>"></td>
    </tr>
    <tr>
        <td><input type="submit" name="btnUpdate" value="Update Genre"></td>
    </tr>
</table>