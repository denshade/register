<?php
require_once "../settings.php";
require_once "daos/ConceptDao.php";

require_once "connection.php";

$pdo = getConnectionFromSession();
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
    <div class="alert alert-info"><h1>The available concepts</h1></div>
    <table class="table">
        <thead><tr>
        <th>Name</th><th></th><th></th><th></th>
        </tr></thead>
        <tbody>
<?php
        $conceptDao = new ConceptDao($pdo);
        foreach($conceptDao->getConcepts() as $concept)
        {
            echo "<tr>
                    <td>$concept</td>
                    <td><a href='view_concept_list.php?concept=$concept'>Edit data</a></td>
                    <td><a href='manipulatecolumns.php?concept=$concept'>Edit schema</a></td>
                    <td><a href='dropconcept.php?concept=$concept'>Remove concept</a></td>
                    </tr>";
        }

    ?>

        </tbody>
    </table>
    <button class="btn btn-success" onclick='window.location.href="addconcept.php";'>Add concept</button>
    <hr/>
    <div>
        <div class="alert alert-info"><h1>The available links</h1></div>
    <table class="table">
        <thead><tr>
        <th>Name</th><th></th><th></th><th></th>
        </tr></thead>
        <tbody>
        <?php
        $conceptDao = new ConceptDao($pdo);
        foreach($conceptDao->getConceptLinks() as $concept)
        {
            $fromConcept = $concept[0];
            $toConcept = $concept[1];

            echo "<tr>
                    <td>$fromConcept => $toConcept</td>
                    <td><a href='addlinkdata.php?concept=_${fromConcept}2${toConcept}'>Add link data</a></td>
                    <td><a href='combinedata.php?concept1=${fromConcept}&concept2=${toConcept}'>Combine data</a></td>
                    <td><a href='removelinkret.php?concept=_${fromConcept}2${toConcept}'>Remove link</a></td>
                    </tr>";
        }
        ?>

        </tbody>
    </table>
    <button class="btn btn-success" onclick='window.location.href="addlinkconcepts.php";'>Link two concepts</button>
</div>
    </body>
    </html>
