<?php
require_once "ConceptDao.php";
require_once "../settings.php";

$concept = $_GET["concept"];
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename('export'.$concept.'.csv'));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

try {
    $pdo = getConnection();
    $conceptDao = new ConceptDao($pdo);
} catch (Exception $exception)
{

}

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