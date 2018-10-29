<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";


require "connection.php";

$concept = $_GET["concept"];
$oldcolumnname = $_GET["column"];
$newcolumnname = $_GET["name"];
$columntype = $_GET["type"];

if ($columntype == "enum")
{
    $options = $_GET["options"];
    $optionArray = explode("\n", str_replace("\r", "", $options));
    $quotedArray = [];
    foreach ($optionArray as $option)
    {
        $quotedArray []= '\''.$option.'\'';
    }
    $enum = "enum(".implode(",", $quotedArray).")";
    $columntype = $enum;
}


$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->updateColumn($concept, $oldcolumnname, $newcolumnname, $columntype);
    AuditTrail::audit($login, "Updated a column $oldcolumnname to $newcolumnname with type $columntype on concept $concept");
    header("Location: manipulatecolumns.php?concept=$concept");
}catch (Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
