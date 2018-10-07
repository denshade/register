<?php
require_once "ConceptDao.php";
require_once "../settings.php";


$pdo = getConnection();

$concept = $_GET["concept"];
$columnname = $_GET["name"];

$conceptDao = new ConceptDao($pdo);
$success = $conceptDao->dropTableColumn($concept, $columnname, $columntype);
if ($success)
{
    header("Location: addcolumn.php?concept=$concept");
}
