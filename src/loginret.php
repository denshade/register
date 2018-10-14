<?php
require_once "../settings.php";

$login = $_POST["login"];
$password = $_POST["password"];
$_SESSION["login"] = $login;
$_SESSION["password"] = $password;

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
    //redirect to login.php
}

header("Location: index.php");
