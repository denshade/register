<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";
$pdo = getConnectionFromSession();
$conceptDao = new ConceptDao($pdo);
$concept = $_GET["concept"];
$oldcolumnname = $_GET["column"];
$attributes = $conceptDao->getAttributes($concept);
$currentAttribute = null;
foreach ($attributes as $attribute) {
    if ($attribute->name == $oldcolumnname)
    {
        $currentAttribute = $attribute;
    }
}
$booleanSelected = "";
$intSelected = "";
$doubleSelected = "";
$varcharSelected = "";
$enumSelected = "";
$textSelected = "";
$dateSelected = "";
$datetimeSelected = "";
$optionsLines = "";

if ($currentAttribute->isBoolean()) $booleanSelected = "selected";
if ($currentAttribute->isInt()) $intSelected = "selected";
if ($currentAttribute->isDouble()) $doubleSelected = "selected";
if ($currentAttribute->isVarchar()) $varcharSelected = "selected";
if ($currentAttribute->isEnum()) $enumSelected = "selected";
if ($currentAttribute->isText()) $textSelected = "selected";
if ($currentAttribute->isDate()) $dateSelected = "selected";
if ($currentAttribute->isDateTime()) $datetimeSelected = "selected";


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
                        <input type="text" onkeyup="removeSpaces('name');" required pattern="[a-zA-Z][a-zA-Z0-9_]*" class="form-control" name="name" id="name"
                               value="<?php echo $oldcolumnname; ?>">
                    </div>
                </div>
            </div>
            <input type="hidden" name="concept" id="concept" value="<?php echo $concept; ?>">
            <input type="hidden" name="column" id="column" value="<?php echo $oldcolumnname; ?>">

            <label for="name" class="cols-sm-2 control-label">Type of the new column</label>
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    <select class="form-control"  id="type" onchange="setreadonly();" name="type">
                        <option <?php echo $booleanSelected;?> value="boolean">Boolean</option>
                        <option <?php echo $doubleSelected;?> value="double">Decimal</option>
                        <option <?php echo $dateSelected;?> value="date">Date</option>
                        <option <?php echo $datetimeSelected;?> value="datetime">DateTime</option>
                        <option <?php echo $intSelected;?> value="int">Integer [-2147483648 to 2147483647]</option>
                        <option <?php echo $varcharSelected;?> value="varchar(255)">Limited Size Text [255 characters]</option>
                        <option <?php echo $enumSelected;?> value="enum">Limited list of options</option>
                        <option <?php echo $textSelected;?> value="text">Unlimited text</option>
                    </select>
                </div>
            </div>
    </div>

    <div>
        <label>Options</label>
        <div class="cols-sm-10">
            <div class="input-group">
                <?php
                if ($currentAttribute->isEnum())
                {
                    $options = substr($currentAttribute->type, strlen("enum("));
                    $options = substr($options, 0, strlen($options) - 1);
                    $optionsArray = explode(",", $options);
                    $cleanOptions = [];
                    foreach($optionsArray as $option)
                    {
                        $cleanOptions []= substr($option, 1, strlen($option) - 2);
                    }
                    $optionsLines = implode("\n", $cleanOptions);
                }
                ?>
                <textarea id="options" class="form-control" name="options"><?php echo $optionsLines;?></textarea>
            </div>
        </div>
    </div>
    <p/>
    <input type="hidden" name="concept" id="concept" value="<?php echo $concept; ?>">





    <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input class="btn btn-success" type="Submit" value="Update column"> &nbsp;
                        <button class="btn btn-secondary" onclick="window.history.back();return false;">Cancel</button>
                    </div>
                </div>
            </div>


        </form>

    <script>
        setreadonly();

    </script>

</div>
</body>
</html>