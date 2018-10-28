<?php
require_once "UserDao.php";
require_once "../settings.php";

require "connection.php";

$user = $_GET["user"];


$userDao = new UserDao($pdo);
try {
    $userDao->deleteUser($user);
    header("Location: users.php");
} catch(Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
