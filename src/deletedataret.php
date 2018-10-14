<?php
require_once "ConceptDao.php";
require_once "../settings.php";

require "connection.php";

$concept = $_GET["concept"];
$id = $_GET["id"];


$conceptDao = new ConceptDao($pdo);
$success = $conceptDao->deleteData($concept, $id);
if ($success)
{
    header("Location: view_concept_list.php?concept=$concept");
}
