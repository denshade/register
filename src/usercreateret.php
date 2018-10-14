<?php
require "../settings.php";
require "connection.php";
require_once "UserDao.php";

$username = $_POST["new_username"];
$password = $_POST["new_password"];

$create = @$_POST["create"];
$drop   = @$_POST["drop"];
$delete = @$_POST["delete"];
$insert = @$_POST["insert"];
$update = @$_POST["update"];

//alter
//grant


$conceptDao = new UserDao($pdo);
$success = $conceptDao->createUser($username, $password, $create, $drop, $delete, $insert, $update);
if ($success)
{
    header("Location: users.php");
}