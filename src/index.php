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
    <div class="jumbotron">
        <h1>The available concepts:</h1>
            </div>
    <table class="table">
        <thead>
        <th>Name</th><th></th><th></th><th></th>
        </thead>
        <tbody>
<?php
        $conceptDao = new ConceptDao($pdo);
foreach($conceptDao->getConcepts() as $concept)
{
    echo "<tr><td>$concept</td><td><a href='view_concept_list.php?concept=$concept'>View data</a></td><td><a href='dataentryform.php?concept=$concept'>Add data</a></td><td><a href='addcolumn.php?concept=$concept'>Add columns</a></td></tr>";
}

//SELECT table_name FROM information_schema.tables where table_schema='your_database_name';

//if no login => redirect to login.
//Show the available concepts.
    ?>
        </tbody>
    </table>
    </div>
    </body>
    </html>
