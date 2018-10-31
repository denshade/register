<?php

require_once "daos/ConceptDao.php";
require_once "../settings.php";
require_once "daos/AuditTrail.php";


require "connection.php";
$pdo = getConnectionFromSession();
$conceptDao = new ConceptDao($pdo);
$concept = $_GET["concept"];
$columnname = $_GET["column"];
$moveafterselect = $_GET["moveafterselect"];
$type = $_GET["type"];
try {
    $conceptDao->moveColumnAfter($concept, $columnname, $type, $moveafterselect);
    header("Location: manipulatecolumns.php?concept=$concept");

} catch (Exception $e)
{
    require_once "ErrorView.php";
    ErrorView::showError($e);
}
