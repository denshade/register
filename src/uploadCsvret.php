<?php
require_once "../settings.php";
require_once "connection.php";
require_once "daos/ConceptDao.php";
$pdo = getConnectionFromSession();
$conceptDoa = new ConceptDao($pdo);
$concept = $_POST["concept"];
$file = $_FILES["inputfile"]["tmp_name"];
if ($file == null) {
    require_once("ErrorView.php");
    ErrorView::showError(new Exception("No file provided."));
    return;
}

try {
    $rows = [];
    if (($handle = fopen($file, "r")) !== FALSE) {
        $header = fgetcsv($handle, 1000, ",");
        $entity = [];
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            foreach ($header as $headerNr => $headerName) {
                $entity [$headerName] = $row[$headerNr];//check if exists.
            }
            $conceptDoa->addDataForConcept($concept, $entity, false);
            echo "Successfully imported ".$row[0]."<BR/>";
        }
        fclose($handle);
    } else {
        throw new Exception("Unable to open file");
    }

} catch (Exception $e) {
    require_once("ErrorView.php");
    ErrorView::showError($e);
}
