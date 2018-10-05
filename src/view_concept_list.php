<?php
require_once "ConceptDao.php";
require_once "../settings.php";

try {
    $pdo = getConnection();
} catch (PDOException $exception)
{
    header("Location: login.php");
    return;
    //redirect to login.php
}
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
                    foreach ($conceptDao->getConcepts() as $conceptOption)
                    {
                        $selected = "";
                        if ( $conceptOption == $concept)
                        {
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
            $attributes = $conceptDao->getAttributesNames($concept);
            foreach ($attributes as $attribute)
            {
                echo "<th>$attribute</th>";
            }
            ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($conceptDao->getDataForConcept($concept) as $dataRow)
            {
                echo "<tr>";
                foreach ($attributes as $attribute)
                {
                    echo "<td>$dataRow[$attribute]</td>";
                }
                echo "</tr>";

            }
            ?>
            </tbody>
        </table>
        <script>$('#concept').DataTable( { paging: false });</script>

<?php
// Get the username/password from the session.
// check if you can connect using the username/pwd.
// Check if the table exists.
// Build the header.
// SELECT * FROM table.
//
?>
</div>