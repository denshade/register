<?php
require_once "ConceptDao.php";
require_once "../settings.php";


$pdo = getConnection();

$concept = $_GET["concept"];
$columnname = $_GET["name"];
$columntype = $_GET["type"];


$conceptDao = new ConceptDao($pdo);
$conceptDao->addTableColumn($concept, $columnname, $columntype);
header("Location: addcolumn.php?concept=$concept");
