<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";
require "connection.php";
$pdo = getConnectionFromSession();

$concept = $_GET["concept"];
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename('export'.$concept.'.csv'));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

$conceptDao = new ConceptDao($pdo);
$attributes = $conceptDao->getAttributesNames($concept);
echo implode(",", $attributes)."\n";
$attributes = $conceptDao->getAttributesNames($concept);

foreach ($conceptDao->getDataForConcept($concept) as $dataRow) {
    $attributeRow = [];
    foreach($attributes as $attribute)
    {
        $attributeRow []= '"'.$dataRow[$attribute].'"';
    }
    echo implode(",", $attributeRow)."\n";
}