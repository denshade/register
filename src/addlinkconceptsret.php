<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";


require "connection.php";

$sourceconcept = $_GET["sourceconcept"];
$destinationconcept = $_GET["destinationconcept"];


$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->linkConcept($sourceconcept, $destinationconcept);
    header("Location: index.php");

} catch (Exception $e) {
    require_once("ErrorView.php");
    ErrorView::showError($e);
}