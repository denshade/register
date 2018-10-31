<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";
$pdo = getConnectionFromSession();
$conceptDao = new ConceptDao($pdo);
$concept = @$_GET["concept"]
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
    <h1><div class="alert alert-info">Export database</div></h1>
    <button class="btn btn-success" onclick='window.location.href="exportschema.php";'>Export database schema (no data)</button>
    <hr/>
    <h1><div class="alert alert-info">Import database</div></h1>

    <form action="portdata.php" class="form-horizontal">
        Data for <select class="form-control" name="concept" onchange="this.form.submit();">
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

    <form action="uploadCsvret.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden"  name="concept" value="<?php echo $concept;?>"/>
        <label>CSV file for <?php echo $concept; ?></label><input name="inputfile" required class="form-control" type="file"/><BR/>
        <input type="submit" class="form-control" value="Load this data"/>
    </form>
</div>

</body>
</html>