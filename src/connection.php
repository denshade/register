<?php
session_start();
$login = @$_SESSION["login"];
$password = @$_SESSION["password"];
if ($login == null || $password == null)
{
    header("Location: login.php");
    return;
}

function getConnection($username, $password)
{
    return new PDO(getDbString(), $username, $password);
}


try {
    $pdo = getConnection($login, $password);
} catch (PDOException $exception)
{
    error_log(var_export($exception, true));
    header("Location: login.php");
    return;
    //redirect to login.php
}