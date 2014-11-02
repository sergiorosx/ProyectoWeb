<?php

session_start();
require('twitteroauth/twitteroauth.php');
require('config.php');

if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
$access_token = $_SESSION['access_token'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$content = $connection->get('account/verify_credentials');

//echo "<pre>", print_r($content, true), "</pre>";

echo "<b>Hi </b>" . $content->name . "<br>";
echo "<b>Hi </b>" . $content->screen_name . "<br>";
echo "<b>Is this you ?</b><br>";
echo "<p>ruta de imagen ". $content->profile_image_url ."</p>";
echo "<img src = " . $content->profile_image_url . ">";

echo "<br><a href = 'clearsessions.php'>Logout</a>";
?>