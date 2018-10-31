<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";
$pdo = getConnectionFromSession();

$conceptDao = new ConceptDao($pdo);
$concepts = $_GET["concept"];
$conceptArray = explode("2", substr($concepts, 1));

$concept1 = $conceptArray[0];
$concept2 = $conceptArray[1];


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
        <h1><?php echo "Link from $concept1";?></h1>
        <form action="addlinkdataret.php" method="get">
            <input type="hidden" name="concept1" value="<?php echo $concept1;?>">
            <input type="hidden" name="concept2" value="<?php echo $concept2;?>">

        <table class="display nowrap dataTable dtr-inline collapsed" id="concept">
            <thead>
            <tr>
                <?php
                $attributes = $conceptDao->getAttributesNames($concept1);
                echo "<th></th>"; //id row.
                foreach ($attributes as $attribute)
                {
                    echo "<th>$attribute</th>";
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($conceptDao->getDataForConcept($concept1) as $dataRow)
            {
                echo "<tr>";
                $idAttribute = $attributes[0];
                $idCheckbox = "<input type='checkbox' name='1_$dataRow[$idAttribute]'>";
                $counter = 0;
                foreach ($attributes as $attribute)
                {
                    if ($counter++ == 0)
                    {
                        echo "<td>$idCheckbox $dataRow[$attribute]</td>";
                    }
                    echo "<td>$dataRow[$attribute]</td>";
                }
                echo "</tr>";

            }
            ?>
            </tbody>
        </table>
        <h1><?php echo "Link to $concept2";?></h1>

        <table class="display nowrap dataTable dtr-inline collapsed" id="concept">
            <thead>
            <tr>
                <?php
                $attributes = $conceptDao->getAttributesNames($concept2);
                foreach ($attributes as $attribute)
                {
                    echo "<th>$attribute</th>";
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($conceptDao->getDataForConcept($concept2) as $dataRow)
            {
                echo "<tr>";
                $idAttribute = $attributes[0];
                $idCheckbox = "<input type='checkbox' name='2_$dataRow[$idAttribute]'>";
                $counter = 0;
                foreach ($attributes as $attribute)
                {
                    if ($counter++ == 0)
                    {
                        echo "<td>$idCheckbox $dataRow[$attribute]</td>";
                    } else {
                        echo "<td>$dataRow[$attribute]</td>";
                    }
                }
                echo "</tr>";

            }
            ?>
            </tbody>
        </table>

        <input type="submit" class="btn btn-primary" value="Link the selected data"/>
        </form>

</div>
</body>
</html>