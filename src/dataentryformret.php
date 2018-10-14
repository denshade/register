<?php
require_once "ConceptDao.php";
require_once "../settings.php";
require "connection.php";

$concept = $_GET["concept"];


$conceptDao = new ConceptDao($pdo);
$success = $conceptDao->addDataForConcept($concept, $_GET);
if ($success)
{
    header("Location: view_concept_list.php?concept=$concept");
}
