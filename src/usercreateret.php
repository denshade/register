<?php
require "../settings.php";
require "connection.php";
$pdo = getConnectionFromSession();
require_once "daos/UserDao.php";

$username = $_POST["new_username"];
$password = $_POST["new_password"];

$create = @$_POST["create"];
$drop   = @$_POST["drop"];
$delete = @$_POST["delete"];
$insert = @$_POST["insert"];
$update = @$_POST["update"];
$grant  = @$_POST["grant"];

//alter
//grant


$conceptDao = new UserDao($pdo);
try {
    $conceptDao->createUser($username, $password, $create, $drop, $delete, $insert, $update, $grant);
    AuditTrail::audit($login, "Created a user $username");
    header("Location: users.php");
} catch (Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
