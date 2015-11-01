<?php
require 'user.php';
   if( isset($_POST["nombre"]) && isset($_POST["email"]) )
   {
      if (preg_match("/[^A-Za-z'- ]/",$_POST['nombre'] ))
      {
         die ("Nombre invalido");
      }
      echo "Bienvenido ". $_POST['nombre']. "<br />";
      User::create($_POST['nombre'], $_POST['email']);

      User::readAll();      

      //exit();
   }
?>