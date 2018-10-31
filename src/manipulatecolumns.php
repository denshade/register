<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";
$pdo = getConnectionFromSession();
$conceptDao = new ConceptDao($pdo);
$concept = $_GET["concept"];

?>
<html>
<head>
    <?php
    include "headerbootstrap.php";
    ?>
</head>
<body>
<div class="container-fluid">
    <?php
    include "navbar.php";
    ?>
    <br/>


        <h1>
            Currently available columns.
        </h1>
        <table class="display nowrap dataTable dtr-inline collapsed" id="concept">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th><!--Remove button--></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $attributes = $conceptDao->getAttributes($concept);
            $counter = 0;
            foreach ($attributes as $attribute) {
                $button = "";
                if ($counter++ > 0) {
                    $button = "<form style='display:inline' action='updatecolumn.php'><input type='submit' class='btn btn-warning' value='...'/><input type='hidden' name='concept' value='$concept'><input type='hidden' name='column' value='$attribute->name'></form>&nbsp;";
                    $button .= "<form style='display:inline' action='removecolumnret.php'><input type='submit' class='btn btn-danger' value='X'/><input type='hidden' name='concept' value='$concept'><input type='hidden' name='column' value='$attribute->name'></form>";
                }
                echo "<tr>";
                echo "<td>$attribute->name</td><td>$attribute->type</td><td>$button</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    <?php
    echo '<button class="btn btn-primary" onclick="window.location.href = \'addcolumn.php?concept='.$concept.'\';return false;">Add concept</button>';?>

    </div>


</body>
</html>