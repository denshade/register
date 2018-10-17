<?php
require_once "ConceptDao.php";
require_once "../settings.php";

require "connection.php";

$conceptDao = new ConceptDao($pdo);
$concept = $_GET["concept"];
$oldcolumnname = $_GET["column"];

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
        <h1>Alter column <?php echo $oldcolumnname; ?> for <?php echo $concept; ?></h1>
        <form class="form-horizontal" action="updatecolumnret.php">
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">New name of the column</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" onkeyup="removeSpaces('name');" class="form-control" name="name" id="name"
                               placeholder="Enter the new name of the column">
                    </div>
                </div>
            </div>
            <input type="hidden" name="concept" id="concept" value="<?php echo $concept; ?>">
            <input type="hidden" name="concept" id="column" value="<?php echo $oldcolumnname; ?>">

            <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input class="btn btn-success" type="Submit" value="Update column">
                    </div>
                </div>
            </div>


        </form>

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
                    $button = "<form action='removecolumnret.php'><input type='submit' class='btn btn-warning' value='X'/><input type='hidden' name='concept' value='$concept'><input type='hidden' name='column' value='$attribute->name'></form>";
                }
                echo "<tr>";
                echo "<td>$attribute->name</td><td>$attribute->type</td><td>$button</td>";
                echo "</tr>";
            }
            ?>

    </div>

    <script>
        setreadonly();

    </script>

</div>
</body>
</html>