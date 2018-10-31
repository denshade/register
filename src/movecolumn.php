<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";
$pdo = getConnectionFromSession();
$conceptDao = new ConceptDao($pdo);
$concept = $_GET["concept"];
$columnname = $_GET["column"];
$attributes = $conceptDao->getAttributes($concept);
$currentAttribute = null;
foreach ($attributes as $attribute) {
    if ($attribute->name == $columnname)
    {
        $currentAttribute = $attribute;
    }
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
    <br/>

    <div class="container-fluid">
        <h1>Move column <?php echo $columnname; ?> for <?php echo $concept; ?> after </h1>
        <form class="form-horizontal" action="movecolumnret.php">
            <input type="hidden" name="concept" value="<?php echo $concept; ?>"/>
            <input type="hidden" name="column" value="<?php echo $columnname; ?>"/>
            <input type="hidden" name="type" value="<?php echo $currentAttribute->type; ?>"/>
            <div class="form-group">
                <select name="moveafterselect" class="form-control">
                    <?php
                    foreach($attributes as $attribute)
                    {
                        echo "<option value='$attribute->name'>$attribute->name</option>";
                    }
                    ?>
                </select><BR/>

    <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input class="btn btn-success" type="Submit" value="Update column"> &nbsp;
                        <button class="btn btn-secondary" onclick="window.history.back();return false;">Cancel</button>
                    </div>
                </div>
            </div>


        </form>


</div>
</body>
</html>