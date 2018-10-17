<?php
require_once "ConceptDao.php";
require_once "../settings.php";


require "connection.php";

$concept = $_GET["concept"];
$oldcolumnname = $_GET["column"];
$name = $_GET["name"];

$conceptDao = new ConceptDao($pdo);
$conceptDao->updateColumn($concept, $oldcolumnname, $name);
