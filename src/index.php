<?php
require_once "../settings.php";
require_once "ConceptDao.php";


try {
    $pdo = getConnection();
} catch (PDOException $exception)
{
    header("Location: login.php");
    return;
    //redirect to login.php
}

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
    <h1><div class="alert alert-info">The available concepts</div></h1>
    <table class="table">
        <thead>
        <th>Name</th><th></th><th></th><th></th><th></th>
        </thead>
        <tbody>
<?php
        $conceptDao = new ConceptDao($pdo);
        foreach($conceptDao->getConcepts() as $concept)
        {
            echo "<tr>
                    <td>$concept</td>
                    <td><a href='view_concept_list.php?concept=$concept'>View data</a></td>
                    <td><a href='dataentryform.php?concept=$concept'>Add data</a></td>
                    <td><a href='addcolumn.php?concept=$concept'>Add columns</a></td>
                    <td><a href='dropconcept.php?concept=$concept'>Remove concept</a></td>
                    </tr>";
        }

    ?>

        </tbody>
    </table>
    <button class="btn btn-success" onclick='window.location.href="addconcept.php";'>Add concept</button>
    <hr/>
    <div>
    <h1><div class="alert alert-info">The available links</div></h1>
    <table class="table">
        <thead>
        <th>Name</th><th></th><th></th>
        </thead>
        <tbody>
        <?php
        $conceptDao = new ConceptDao($pdo);
        foreach($conceptDao->getConceptLinks() as $concept)
        {
            $fromConcept = $concept[0];
            $toConcept = $concept[1];

            echo "<tr>
                    <td>$fromConcept => $toConcept</td>
                    <td><a href='removelinkret.php?concept=_${fromConcept}2${toConcept}'>Remove link</a></td>
                    <td><a href='addlinkdata.php?concept=_${fromConcept}2${toConcept}'>Add link data</a></td>
                    </tr>";
        }

        ?>

        </tbody>
    </table>
    <button class="btn btn-success" onclick='window.location.href="addlinkconcepts.php";'>Link two concepts</button>
    </div>
</div>
    </body>
    </html>
