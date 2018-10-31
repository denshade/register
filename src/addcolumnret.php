<?php
require_once "daos/ConceptDao.php";
require_once "daos/AuditTrail.php";

require_once "../settings.php";


require "connection.php";

$pdo = getConnectionFromSession();

$concept = $_GET["concept"];
$columnname = $_GET["name"];
$columntype = $_GET["type"];
if ($columntype == "enum")
{
    $options = $_GET["options"];
    $optionArray = explode("\n", str_replace("\r", "", $options));
    $quotedArray = [];
    foreach ($optionArray as $option)
    {
        $quotedArray []= '"'.$option.'"';
    }
    $enum = "enum(".implode(",", $quotedArray).")";
    $columntype = $enum;
}

$conceptDao = new ConceptDao($pdo);
try {
    $conceptDao->addTableColumn($concept, $columnname, $columntype);
    AuditTrail::audit($login, "Added column to $concept by name $columnname type: $columntype");
    header("Location: addcolumn.php?concept=$concept");
}catch (Exception $e)
{
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
