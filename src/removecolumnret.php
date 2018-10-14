<?php
require_once "ConceptDao.php";
require_once "../settings.php";


require "connection.php";

$concept = $_GET["concept"];
$columnname = $_GET["column"];

$conceptDao = new ConceptDao($pdo);
$success = $conceptDao->dropTableColumn($concept, $columnname);
if ($success)
{
    header("Location: addcolumn.php?concept=$concept");
}
