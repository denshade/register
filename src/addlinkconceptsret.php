<?php
require_once "ConceptDao.php";
require_once "../settings.php";


$pdo = getConnection();

$sourceconcept = $_GET["sourceconcept"];
$destinationconcept = $_GET["destinationconcept"];


$conceptDao = new ConceptDao($pdo);
$success = $conceptDao->linkConcept($sourceconcept, $destinationconcept);
if ($success)
{
    header("Location: index.php");
}