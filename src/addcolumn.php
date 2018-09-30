<?php
require_once "ConceptDao.php";
require_once "../settings.php";

try {
    $pdo = getConnection();
} catch (PDOException $exception) {
    http_redirect("login.php");
    //redirect to login.php
}
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
                        <input type="text" class="form-control" name="name" id="name"
                               placeholder="Enter the name of column">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Type of the new column</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <select class="form-control" id="type" name="type">
                            <option value="boolean">Boolean</option>
                            <option value="double">Decimal</option>
                            <option value="date">Date</option>
                            <option value="datetime">DateTime</option>
                            <option value="int">Integer(-2147483648 to 2147483647)</option>
                            <option value="varchar(255)">Limited Size Text(255)</option>
                            <option value="enum">Limited list of options</option>
                            <option value="text">Unlimited text</option>
                        </select>
                    </div>
                </div>
            </div>
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
            </tr>
            </thead>
            <tbody>
            <?php
            $attributes = $conceptDao->getAttributes($concept);
            foreach ($attributes as $attribute) {
                echo "<tr><td>$attribute->name</td><td>$attribute->type</td></tr>";
            }
            ?>

            <?php
            // Get the username/password from the session.
            // check if you can connect using the username/pwd.
            // Check if the table exists.
            // Build the header.
            // SELECT * FROM table.
            //
            ?>
    </div>

</div>
</body>
</html>