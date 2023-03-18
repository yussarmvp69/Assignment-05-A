<?php
function fetchBookFromDb()
{
    $link = createMySQLConnection();
    $query = "SELECT book.isbn, book.title, book.author, book.publisher, book.publish_year, book.short_description, genre.name AS 'genre_name' 
            FROM book INNER JOIN genre WHERE book.genre_id = genre.id";
    $stmt = $link->prepare($query);
    $stmt ->execute();
    $results=$stmt->fetchAll();
    $link = null;
    return $results;
}

function addNewBook($newTitle,$newAuthor,$newPublisher,$newPublishYear,$newDescription,$newCover,$newGenreId)
{
    $result = 0;
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = "INSERT INTO book(isbn, title, author, publisher, publish_year, short_description, cover, genre_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $newTitle);
    $stmt->bindParam(2, $newAuthor);
    $stmt->bindParam(3, $newPublisher);
    $stmt->bindParam(4, $newPublishYear);
    $stmt->bindParam(5, $newDescription);
    $stmt->bindParam(6, $newCover);
    $stmt->bindParam(7, $newGenreId);
    $stmt->bindParam(8, $isbn);
        if($stmt->execute()){
            $link->commit();
            $result = 1;
        }else{
            $link->rollBack();
        }
        $link = null;
    return $result;
}
function fetchOneBook($isbn)
{
    $link = createMySQLConnection();
    $query =' SELECT isbn, title , author, publisher , publish_year, short_description, cover, genre_id FROM book WHERE isbn = ?';
    $stmt = $link->prepare($query);
    $stmt ->bindParam(1,$isbn);
    $stmt ->execute();
    $results=$stmt->fetch();
    $link = null;
    return $results;
}

function updateBooktoDb($isbn,$newTitle,$newAuthor,$newPublisher,$newPublishYear,$newDescription,$newCover,$newGenreId)
{
    $result = 0;
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'UPDATE book SET title = ?, author = ?, publisher = ?, publish_year = ?, short_description = ?, genre_id = ? WHERE  isbn = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $newTitle);
    $stmt->bindParam(2, $newAuthor);
    $stmt->bindParam(3, $newPublisher);
    $stmt->bindParam(4, $newPublishYear);
    $stmt->bindParam(5, $newDescription);
    $stmt->bindParam(6, $newCover);
    $stmt->bindParam(7, $newGenreId);
    $stmt->bindParam(8, $isbn);
    if ($stmt->execute()) {
        $link->commit();
        $result=1;
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}
function deleteBookFromdb($isbn)
{
    $result = 0;
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'DELETE book SET name = ? WHERE id = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $isbn);
    if ($stmt->execute()) {
        $link->commit();
        $result=1;
    } else {
        $link->rollBack();
    }
    $link = null;
    return $result;
}
?>