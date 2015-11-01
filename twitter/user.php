<?php
require 'database.php';

Class User{

  public static function readWithProvider($oauth_provider,$oauth_uid)
  {
    $sql = 'SELECT * FROM users WHERE oauth_provider = :oauth_provider and oauth_uid=:oauth_uid';
    try {
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":oauth_provider", $oauth_provider);
        $stmt->bindParam(":oauth_uid", $oauth_uid);
        $stmt->execute();
        $user = $stmt->fetchObject();
        Database::disconnect();
        return $user;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
  }

  public static function createWithProvider($oauth_provider,$oauth_uid,$username,$oauth_token,$oauth_secret)
  {
    $sql = 'INSERT INTO users (oauth_provider, oauth_uid, username, oauth_token, oauth_secret) VALUES (:oauth_provider, :oauth_uid, :username, :oauth_token, :oauth_secret)';
        try {
          $db = Database::connect();
          $stmt = $db->prepare($sql);
          $stmt->bindParam(':oauth_provider', $oauth_provider);
          $stmt->bindParam(':oauth_uid', $oauth_uid);
          $stmt->bindParam(':username', $username);
          $stmt->bindParam(':oauth_token', $oauth_token);
          $stmt->bindParam(':oauth_secret', $oauth_secret);
          $stmt->execute();
          Database::disconnect();
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
  }

  public static function updateWithProvider($oauth_token, $oauth_secret,$oauth_provider,$oauth_uid){
    $sql = 'UPDATE users SET oauth_token = :oauth_token, oauth_secret = :oauth_secret WHERE oauth_provider = :oauth_provider AND oauth_uid = :oauth_uid';
    try {
      $db = Database::connect();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":oauth_token", $oauth_token);
      $stmt->bindParam(":oauth_secret", $oauth_secret);
      $stmt->bindParam(":oauth_provider", $oauth_provider);
      $stmt->bindParam(":oauth_uid", $oauth_uid);
      $stmt->execute();
      Database::disconnect();
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

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
        Database::disconnect();
        return $users;
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
        Database::disconnect();
        return $user;
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
  }

}


?>