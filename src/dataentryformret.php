<?php
require_once "daos/ConceptDao.php";
require_once "daos/AuditTrail.php";
require_once "../settings.php";
require "connection.php";

$concept = $_GET["concept"];


$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->addDataForConcept($concept, $_GET);
    AuditTrail::audit($login, "Added data for $concept");

    header("Location: view_concept_list.php?concept=$concept");
} catch (Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}


