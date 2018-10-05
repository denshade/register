<?php
require_once "ConceptDao.php";
require_once "../settings.php";


$pdo = getConnection();

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
$success = $conceptDao->addTableColumn($concept, $columnname, $columntype);
if ($success)
{
    header("Location: addcolumn.php?concept=$concept");
}
