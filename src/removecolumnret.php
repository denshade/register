<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";


require "connection.php";

$concept = $_GET["concept"];
$columnname = $_GET["column"];

$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->dropTableColumn($concept, $columnname);
    AuditTrail::audit($login, "Removed a table column $columnname on concept $concept");
    header("Location: addcolumn.php?concept=$concept");
} catch (Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
