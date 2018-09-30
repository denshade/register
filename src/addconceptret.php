<?php
require_once "ConceptDao.php";
require_once "../settings.php";


$pdo = getConnection();

$concept = $_GET["concept"];


$conceptDao = new ConceptDao($pdo);
$conceptDao->createConcept($concept);
//header("Location: addcolumn.php?concept=$concept");
