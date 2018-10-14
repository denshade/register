<?php
require_once "ConceptDao.php";
require_once "../settings.php";

require "connection.php";

$conceptDao = new ConceptDao($pdo);
$concept = $_GET["concept"];

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
        <h1>New column for <?php echo $concept; ?></h1>
        <form class="form-horizontal" action="addcolumnret.php">
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Name of the new column</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" onkeyup="removeSpaces('name');" class="form-control" name="name" id="name"
                               placeholder="Enter the name of column">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Type of the new column</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <select class="form-control"  id="type" onchange="setreadonly();" name="type">
                            <option value="boolean">Boolean</option>
                            <option value="double">Decimal</option>
                            <option value="date">Date</option>
                            <option value="datetime">DateTime</option>
                            <option value="int">Integer [-2147483648 to 2147483647]</option>
                            <option value="varchar(255)">Limited Size Text [255 characters]</option>
                            <option value="enum">Limited list of options</option>
                            <option value="text">Unlimited text</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label>Options</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <textarea id="options" class="form-control" name="options"></textarea>
                    </div>
                </div>
            </div>
            <p/>
            <input type="hidden" name="concept" id="concept" value="<?php echo $concept; ?>">

            <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input class="btn btn-success" type="Submit" value="Add column">
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