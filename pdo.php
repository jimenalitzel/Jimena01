<?php
/*
  0. Get started
  0.1 Create a DB called myapp
  0.2 Create a table in myapp called users with 3 fields.
    id        INT     Primary key
    username  TEXT
    password  TEXT
  0.3 Add your username and password to the getConnection()
  0.4 Check that you can connect to your DB
  0.5 For this exercise you can user named or unnamed placeholders. I personally use named
 */
function getConnection() {
    $dbhost='localhost';
    $dbuser='myuser';
    $dbpass='myuser';
    $dbname='myapp';
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

/*
  1. INSERT
  1.1 Create a function called addUser($username, $password) that will add a user to the table users
  * For extra points create a function that encrypts the password before it adds it to the table
  + Remember to add the $db = null; at the end of the try block so you ensure the connection to the db is finished
  + As a trick you might want to use $stmt->rowCount(); and it should return one row. That way you can make an educated guess that it worked
 */
function addUser($username, $password) {
  $sql = 'INSERT INTO users (username, password) VALUES (:username,:password)';
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    echo $stmt->rowCount(); /*Saber cuantas columnas se modificaron.*/

    $db = null; /* Importante: Cierra la conección a la base de datos.*/
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

addUser('Jim', 'Jim');
/*updateUser('3','Karl','aguado2');
deleteUser('4');*/
getAllUsers();
getUser('3');
/*
  2. UPDATE
  2.1 Create a function called updateUser($id, $username) that will update a user to the table users
  + Remember to add the $db = null; at the end of the try block so you ensure the connection to the db is finished
  + As a trick you might want to use $stmt->rowCount(); and it should return one row. That way you can make an educated guess that it worked
 */

function updateUser($id, $username,$password){

  $sql = 'UPDATE users SET username=:username, password=:password WHERE id=:id';

  try{

    $db = getConnection();
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo $stmt->rowCount();

    $db = null;
   }
   catch(PDOException $e){
    echo 'Error'. $e->getMessage();
   }
}

/*
  3. DELETE
  3.1 Create a function called deleteUser($id) that will delete a user to the table users
  + Remember to add the $db = null; at the end of the try block so you ensure the connection to the db is finished
  + As a trick you might want to use $stmt->rowCount(); and it should return one row. That way you can make an educated guess that it worked
 */
function deleteUser($id){
  $sql = 'DELETE FROM users WHERE id=:id';

  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo $stmt->rowCount();

    $db=null;
  } catch (Exception $e) {
    echo 'Error'.$e->getMessage();
  }
}

/*
  4. SELECT *
  4.1 Create a function called getAllUsers() that will return all users in table users
  4.2 You can either fetch an object or an array
  + Remember to add the $db = null; at the end of the try block so you ensure the connection to the db is finished
  + As a trick you might want to use $stmt->rowCount(); and it should return one row. That way you can make an educated guess that it worked
  + You can user print_r() to print the response
 */
function getAllUsers(){
 $sql = 'SELECT * FROM users';

 try {
   $db = getConnection();
   
   $stmt = $db->query($sql);

   $users = $stmt->fetchAll(PDO::FETCH_OBJ);
   
   print_r($users);

   $db=null;
 } catch (Exception $e) {
   echo 'Error' . $e->getMessage();
 }
}

/*
  5. SELECT *
  5.1 Create a function called getUser($id) that will return a user in table users
  5.2 You can either fetch an object or an array
  + Remember to add the $db = null; at the end of the try block so you ensure the connection to the db is finished
  + As a trick you might want to use $stmt->rowCount(); and it should return one row. That way you can make an educated guess that it worked
  + You can user print_r() to print the response
 */
function getUser($id){
  $sql = 'SELECT * FROM users WHERE id=:id';

  try {
    $db = getConnection();

    $stmt = $db->prepare($sql);
    $stmt ->bindParam(':id', $id);
    
    $stmt->execute();

    $user = $stmt->fetchObject();   
   print_r($user);

   $db=null;
  } catch (Exception $e) {
   echo 'Error' . $e->getMessage();  
  }

}

?>