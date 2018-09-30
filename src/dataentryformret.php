<?php
require_once "ConceptDao.php";
require_once "../settings.php";


$pdo = getConnection();

$concept = $_GET["concept"];


$conceptDao = new ConceptDao($pdo);
$conceptDao->addDataForConcept($concept, $_GET);
$success = $conceptDao->createConcept($concept);
if (success)
{
    header("Location: index.php");
}
