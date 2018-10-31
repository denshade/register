<?php
require_once "daos/ConceptDao.php";
require_once "daos/AuditTrail.php";
require_once "../settings.php";

require "connection.php";

$concept = $_GET["concept"];
$id = $_GET["id"];

$pdo = getConnectionFromSession();
$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->deleteData($concept, $id);
    AuditTrail::audit($login, "Deleted data for $concept");
    header("Location: view_concept_list.php?concept=$concept");
} catch(Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
