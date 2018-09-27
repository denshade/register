<?php
require_once "ConceptDao.php";
require_once "../settings.php";


$pdo = getConnection();

$concept = $_GET["concept"];


$conceptDao = new ConceptDao($pdo);
$conceptDao->addDataForConcept($concept, $_GET);
//$conceptDao->addTableColumn($concept, $columnname, $columntype);
//header("Location: view_concept_list.php?concept=$concept");
