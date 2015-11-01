<?php
require 'database.php';

Class User{

  public static function create($username, $password) {
    $sql = 'INSERT INTO users (username, password) VALUES (:username,:password)';
    try {
      $db = Database::connect();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $password);
      $stmt->execute();
      Database::disconnect();
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public static function update($id, $username,$password){
    $sql = 'UPDATE users SET username=:username,password=:password WHERE id=:id';
    try {
      $db = Database::connect();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":username", $username);
      $stmt->bindParam(":password", $password);
      $stmt->execute();
      Database::disconnect();
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public static function delete($id){
    $sql = 'DELETE FROM users WHERE id=:id';
    try {
      $db = Database::connect();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
      Database::disconnect();
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }


  public static function readAll(){
    $sql = "SELECT * FROM users ORDER BY id";
    try {
        $db = Database::connect();
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $users;

        Database::disconnect();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
  }


  public static function read($id){
    $sql = "SELECT * FROM users WHERE id=:id";
    try {
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetchObject();

        return $user;

        Database::disconnect();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
  }

}


?>