<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";

$conceptDao = new ConceptDao($pdo);

$concept = @$_GET["concept"];
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
            <form action="view_concept_list.php">
                Data for <select name="concept" onchange="this.form.submit();">
                    <?php
                    echo "<option value=''></option>";
                        foreach ($conceptDao->getConcepts() as $conceptOption) {
                            $selected = "";
                            if ($conceptOption == $concept) {
                                $selected = "selected=\"selected\"";
                            }
                            echo "<option $selected value='$conceptOption'>$conceptOption</option>";
                    }
                    ?>
                </select>
            </form>
        </h1>
        <table class="display nowrap dataTable dtr-inline collapsed" id="concept">
            <thead>
            <tr>
                <?php
                if (strlen($concept) > 0) {

                    $attributes = $conceptDao->getAttributes($concept);
                    foreach ($attributes as $attribute) {
                        echo "<th>$attribute->name</th>";
                    }
                    echo '<th style="width:  8.33%"><!--delete button--></th>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            if (strlen($concept) > 0) {

                foreach ($conceptDao->getDataForConcept($concept) as $dataRow) {
                    echo "<tr>";
                    $id = $dataRow[$attributes[0]->name];
                    foreach ($attributes as $attribute) {
                        $attributeName = $attribute->name;
                        if ($attribute->isBoolean())
                        {
                            $checked = "";
                            if ($dataRow[$attributeName] == 1)
                            {
                                $checked = "checked";
                            }
                            echo "<td><input class='form-control' disabled type='checkbox' $checked/></td>";
                        } else {
                            echo "<td>$dataRow[$attributeName]</td>";
                        }
                    }
                    echo "<td>
                    <form style='display:inline;' action='editformdata.php'>
                        <input type='hidden' name='concept' value='$concept'/>
                        <input type='hidden' name='id' value='$id'/>
                        <input type='submit' class='btn btn-success' value='...'/>
                    </form>
                    <form style='display:inline;' action='deletedataret.php'>
                        <input type='hidden' name='concept' value='$concept'/>
                        <input type='hidden' name='id' value='$id'/>
                        <input type='submit' class='btn btn-danger' value='X'/>
                    </form>
                    </td>";
                    echo "</tr>";

                }
            }
            ?>
            </tbody>
        </table>
        <?php echo "<input type=\"button\" class=\"btn btn-success\" onclick=\"location.href='dataentryform.php?concept=$concept';\" value=\"Add data\" />";
        echo " <input type=\"button\" class=\"btn btn-success\" onclick=\"location.href='exportdatabase.php?concept=$concept';\" value=\"Download as CSV\" />";
        ?>
        <script>$('#concept').DataTable({paging: false});</script>


    </div>
</div>
</body>
</html>