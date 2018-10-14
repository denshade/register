<?php
require_once "ConceptDao.php";
require_once "../settings.php";


require "connection.php";

$concept = $_GET["concept"];


$conceptDao = new ConceptDao($pdo);
$success = $conceptDao->createConcept($concept);
if ($success)
{
    header("Location: index.php");
}
