<?php
require_once "ConceptDao.php";
require_once "../settings.php";

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename('exportschema.sql'));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

try {
    $pdo = getConnection();
    $conceptDao = new ConceptDao($pdo);
} catch (Exception $exception)
{

}

foreach($conceptDao->getConcepts() as $concept)
{
    echo $conceptDao->showCreateTable($concept)[0]['Create Table']."\r\n";
}