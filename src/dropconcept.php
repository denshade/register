<?php
require_once "daos/ConceptDao.php";
require_once "daos/AuditTrail.php";
require_once "../settings.php";

require "connection.php";

$concept = $_GET["concept"];
$pdo = getConnectionFromSession();
$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->dropTable($concept);
    AuditTrail::audit(getUser(), "Removed a concept $concept");
    header("Location: index.php");
} catch (Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
