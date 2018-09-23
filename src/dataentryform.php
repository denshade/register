<?php
require_once "ConceptDao.php";
require_once "../settings.php";

try {
    $pdo = getConnection();
} catch (PDOException $exception)
{
    header("Location: login.php");
    //redirect to login.php
}
