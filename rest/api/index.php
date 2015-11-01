<?php
header('Content-Type: application/json; charset=utf-8');

require 'vendor/autoload.php';
require 'user.php';

$app = new \Slim\Slim();

// 1. Create a route for a get method to return a user
$app->get('/user/read/:id', function ($id) {
    echo json_encode(User::read($id), JSON_UNESCAPED_UNICODE );
});

// 2. Create a route for a get method to return all users
$app->get('/user/read/', function () {
	echo 'funciona';
	
    echo json_encode(User::readAll(), JSON_UNESCAPED_UNICODE );
});

// 3. Create a route for a post method to create a new user
$app->post('/user/create/:username/:password', function ($username, $password) {
	echo 'funciona';
    echo json_encode(User::create($username, $password), JSON_UNESCAPED_UNICODE );
});

// 4. Create a route for a put method to update a user


// 5. Create a route for a delete method to delete a user



$app->run();

 ?>