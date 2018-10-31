<?php
require_once "daos/ConceptDao.php";
require_once "daos/AuditTrail.php";
require_once "../settings.php";


require "connection.php";
$pdo = getConnectionFromSession();

$sourceconcept = $_GET["sourceconcept"];
$destinationconcept = $_GET["destinationconcept"];


$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->linkConcept($sourceconcept, $destinationconcept);
    AuditTrail::audit($login, "Linked concepts $sourceconcept with $destinationconcept");
    header("Location: index.php");

} catch (Exception $e) {
    require_once("ErrorView.php");
    ErrorView::showError($e);
}