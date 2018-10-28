<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";

$concept = $_GET["concept"];
$id = $_GET["id"];

$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->updateDataForConcept($concept, $id, $_GET);
    header("Location: view_concept_list.php?concept=$concept");
} catch (Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}

