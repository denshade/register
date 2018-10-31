<?php
require_once "daos/ConceptDao.php";
require_once "daos/AuditTrail.php";
require_once "../settings.php";


require "connection.php";
$pdo = getConnectionFromSession();

$concept = $_GET["concept"];


$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->createConcept($concept);
    AuditTrail::audit($login, "Added a new concept $concept");

    header("Location: index.php");
} catch(Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}

