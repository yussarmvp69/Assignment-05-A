<?php 
function login($username, $password){
    $link = createMySQLConnection();
    $query =" SELECT * FROM user WHERE username=? AND password=?";
    $stmt=$link->prepare($query);
    $stmt -> bindParam(1, $username);
    $stmt -> bindParam(2, $password);
    $stmt -> execute();
    $result = $stmt->fetch();
    closeConnection($link);
    return $result;

}
?>