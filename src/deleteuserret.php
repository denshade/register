<?php
require_once "daos/UserDao.php";
require_once "daos/AuditTrail.php";
require_once "../settings.php";

require "connection.php";

$user = $_GET["user"];

$pdo = getConnectionFromSession();
$userDao = new UserDao($pdo);
try {
    $userDao->deleteUser($user);
    AuditTrail::audit($login, "Deleted user for $user");

    header("Location: users.php");
} catch(Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
