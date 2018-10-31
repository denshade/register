<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";
$pdo = getConnectionFromSession();

$conceptDao = new ConceptDao($pdo);

$concept1 = $_GET["concept1"];
$concept2 = $_GET["concept2"];

$firstConceptKeys = [];
$secondConceptKeys = [];
foreach ($_GET as $key => $value)
{
    if (strpos($key, "1_") > -1)
        $firstConceptKeys[] = substr($key, 2);
    if (strpos($key, "2_") > -1)
        $secondConceptKeys[] = substr($key, 2);
}
try {

    foreach ($firstConceptKeys as $firstKey) {
        foreach ($secondConceptKeys as $secondKey) {
            $success = $conceptDao->addDataForConcept("_" . $concept1 . "2" . $concept2, [
                "id$concept1" => $firstKey,
                "id$concept2" => $secondKey
            ], false);
        }

    }
    AuditTrail::audit($login, "Linked data from $concept1 with $concept2."); //TODO audit all changed data.

    header("Location: index.php");
} catch(Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}