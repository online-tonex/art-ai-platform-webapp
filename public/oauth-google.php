<?php
require_once('../vendor/autoload.php'); // ако използваме Google Client Library
require_once('../config/database.php');
require_once('../app/controllers/AuthController.php');

session_start();

$client = new Google_Client();
$client->setClientId('YOUR_GOOGLE_CLIENT_ID');
$client->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET');
$client->setRedirectUri('http://yourdomain.com/public/oauth-google.php');
$client->addScope("email");
$client->addScope("profile");

if (!isset($_GET['code'])) {
    // Пренасочваме към Google Login
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    exit;
} else {
    $client->authenticate($_GET['code']);
    $token = $client->getAccessToken();
    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $googleUser = $oauth->userinfo->get();

    // Запазваме/логваме потребителя
    $auth = new AuthController($pdo);
    $result = $auth->loginWithGoogle($googleUser);

    header("Location: dashboard.php");
    exit;
}
