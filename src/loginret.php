<?php
require_once "../settings.php";

$login = $_POST["login"];
$password = $_POST["password"];
session_start();
$_SESSION["login"] = $login;
$_SESSION["password"] = $password;

function getConnection($username, $password)
{
    return new PDO(getDbString(), $username, $password);
}

if ($login == null || $password == null)
{
    header("Location: login.php");
    return;
}


try {
    $pdo = getConnection($login, $password);
} catch (PDOException $exception)
{
    header("Location: login.php");
    return;
}

header("Location: index.php");
