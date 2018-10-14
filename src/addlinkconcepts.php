<?php
require_once "ConceptDao.php";
require_once "../settings.php";

require "connection.php";

$conceptDao = new ConceptDao($pdo);

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
        <h1>Link concepts.</h1>
        <form class="form-horizontal" action="addlinkconceptsret.php">
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Source concept</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <select name="sourceconcept" id="sourceconcept">
                            <?php
                             foreach ($conceptDao->getConcepts() as $concept)
                             {
                                 echo "<option value='$concept'>$concept</option>";
                             }
                            ?>
                        </select>
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Destination concept</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <select name="destinationconcept" id="destinationconcept">
                            <?php
                            foreach ($conceptDao->getConcepts() as $concept)
                            {
                                echo "<option value='$concept'>$concept</option>";
                            }
                            ?>
                        </select>
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input class="btn btn-success" type="Submit" value="Link concepts">
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>
</body>
</html>