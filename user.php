<?php
require 'database.php';

Class User{

  public static function create($nombre, $correo) {
    $sql = 'INSERT INTO suscriptor (nombre, correo) VALUES (:nombre,:correo)';
    try {
      $db = Database::connect();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':correo', $correo);
      $stmt->execute();
      Database::disconnect();
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public static function update($nuevoCorreo, $nuevoNombre, $correo){
    $sql = 'UPDATE suscriptor SET nombre=:nuevoNombre, correo=:nuevoCorreo WHERE correo=:correo';
    try {
      $db = Database::connect();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":correo", $correo);
      $stmt->bindParam(":nuevoCorreo", $nuevoCorreo);
      $stmt->bindParam(":nuevoNombre", $nuevoNombre);
      $stmt->execute();
      Database::disconnect();
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public static function delete($correo){
    $sql = 'DELETE FROM suscriptor WHERE correo=:correo';
    try {
      $db = Database::connect();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":correo", $correo);
      $stmt->execute();
      Database::disconnect();
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }


  public static function readAll(){
    $sql = "SELECT * FROM suscriptor ORDER BY id";
    try {
        $db = Database::connect();
        $stmt = $db->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        
        while ($CurrentUser=$stmt->fetch())
        {
          echo '<p><b> Nombre: </b>'.$CurrentUser->nombre. '<b> Correo: </b>'.$CurrentUser->correo. '</p>';
        }
        Database::disconnect();

    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
  }
}


?>