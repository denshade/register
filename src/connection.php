<?php
session_start();
$login = $_SESSION["login"];
$password = $_SESSION["password"];
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