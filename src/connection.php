<?php
session_start();

if (getUser() == null || getPassword() == null)
{
    header("Location: login.php");
    return;
}

function getUser()
{
    return @$_SESSION["login"];
}
function getPassword()
{
    return @$_SESSION["password"];
}

function getConnectionFromSession()
{

    $pdo = new PDO(getDbString(), getUser(), getPassword(), [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdoStatement = $pdo->query("SELECT 1 FROM DUAL");
    $pdoStatement->execute();
    return $pdo;
}
