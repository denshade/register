<?php
$concept = $_POST["concept"];
$file = $_FILES["inputfile"]["tmp_name"];

$rows = [];
if (($handle = fopen($file, "r")) !== FALSE) {
    $header = fgetcsv($handle, 1000, ",");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c = 0; $c < $num; $c++)
        {
            echo $data[$c] . "<br />\n";
            echo $data[$c] . "<br />\n";

        }
    }
    fclose($handle);
} else {
    throw new Exception("Unable to open file");
}