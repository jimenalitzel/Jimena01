<?php
require 'config.php';
require 'user.php';
use Abraham\TwitterOAuth\TwitterOAuth;

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) ||
    empty($_SESSION['access_token']['oauth_token']) ||
    empty($_SESSION['access_token']['oauth_token_secret'])
) {
    header('Location: ./clearsessions.php');
    exit;
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];
/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
/* If method is set change API call made. Test is called by default. */
$user = $connection->get("account/verify_credentials");

/*
echo "<pre>";
var_dump($user);
echo "</pre>";
*/

// Let's find the user by its ID
$result = User::readWithProvider('twitter',$user->id);

// If not, let's add it to the database
if(empty($result)){
  User::createWithProvider('twitter',$user->id,$user->screen_name,$access_token['oauth_token'],$access_token['oauth_token_secret']);
  $result = User::readWithProvider('twitter',$user->id);
} else {
    // Update the tokens
  User::updateWithProvider($access_token['oauth_token'], $access_token['oauth_token_secret'],'twitter',$user->id);
  $result = User::readWithProvider('twitter',$user->id);
}

$_SESSION['id'] = $result->id;
$_SESSION['username'] = $result->username;
$_SESSION['oauth_uid'] = $result->oauth_uid;
$_SESSION['oauth_provider'] = $result->oauth_provider;
$_SESSION['oauth_token'] = $result->oauth_token;
$_SESSION['oauth_secret'] = $result->oauth_secret;


if(!empty($_SESSION['username'])){
    // User is logged in, redirect
    header('Location: index.php');
}
