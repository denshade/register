<?php
require_once "ConceptDao.php";
require_once "../settings.php";

require "connection.php";

$conceptDao = new ConceptDao($pdo);

$concept1 = @$_GET["concept1"];
$concept2 = @$_GET["concept2"];
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
    <div class="container-fluid">
        <h1>
                    <?php
                    echo "Combined data from $concept1 to $concept2";
                    ?>
        </h1>
        <table class="display nowrap dataTable dtr-inline collapsed" id="concept">
            <thead>
            <tr>
                <?php
                $attributes1 = $conceptDao->getAttributesNames($concept1);
                $attributes2 = $conceptDao->getAttributesNames($concept2);
                foreach ($attributes1 as $attribute) {
                    echo "<th>$attribute</th>";
                }
                foreach ($attributes2 as $attribute) {
                    echo "<th>$attribute</th>";
                }

                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($conceptDao->getCombinedDataForConcept($concept1, $concept2) as $dataRow) {
                echo "<tr>";
                $id = $dataRow[$attributes1[0]];
                foreach ($attributes1 as $attribute) {
                    echo "<td>$dataRow[$attribute]</td>";
                }
                foreach ($attributes2 as $attribute) {
                    echo "<td>$dataRow[$attribute]</td>";
                }
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <script>$('#concept').DataTable({paging: false});</script>


    </div>
</div>
</body>
</html>