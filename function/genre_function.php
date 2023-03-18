<?php
function fetchGenreFromDb()
{
    $link = createMySQLConnection();
    $query ='SELECT * FROM genre';
    $stmt = $link->query($query);
    $stmt ->execute();
    $results=$stmt->fetchAll();
    $link = null;
    return $results;
}

function addNewGenre($newName)
{
    $result = 0;
    $link = createMySQLConnection();
    $query = 'INSERT INTO genre(name) VALUES(?)';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $newName);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
        $result=1;
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}
function fetchOneGenre($id)
{
    $link = createMySQLConnection();
    $query ="SELECT * FROM genre WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt ->bindParam(1,$id);
    $stmt ->execute();
    $result = $stmt->fetch();
    $link = null;
    return $result;
}

function updateGenretoDb($id,$newName)
{
    $result = 0;
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'UPDATE genre SET name = ? WHERE id = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $newName);
    $stmt->bindParam(2, $id);
    if ($stmt->execute()) {
        $link->commit();
        $result=1;
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}
function deleteGenreFromdb($id)
{
    $result = 0;
    $link = createMySQLConnection();
    $query = 'DELETE FROM genre WHERE id = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $newName);
    $stmt->bindParam(2, $id);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}
?>