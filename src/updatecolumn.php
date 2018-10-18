<?php
require_once "ConceptDao.php";
require_once "../settings.php";

require "connection.php";

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
var_dump($currentAttribute->type);
switch($currentAttribute->type)
{
    case "boolean": $booleanSelected = "selected"; break;
    case "int": $intSelected = "selected"; break;
    case "doubleD": $doubleSelected = "selected"; break;
    case "date": $dateSelected = "selected"; break;
    case "datetime": $datetimeSelected = "selected"; break;
    case "varchar(255)": $varcharSelected = "selected"; break;
    case "text": $varcharSelected = "selected"; break;
    default: throw new Exception("Unknown type:" . $currentAttribute->name .".");
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
        <h1>Alter column <?php echo $oldcolumnname; ?> for <?php echo $concept; ?></h1>
        <form class="form-horizontal" action="updatecolumnret.php">
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">New name of the column</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" onkeyup="removeSpaces('name');" class="form-control" name="name" id="name"
                               placeholder="<?php echo $oldcolumnname; ?>">
                    </div>
                </div>
            </div>
            <input type="hidden" name="concept" id="concept" value="<?php echo $concept; ?>">
            <input type="hidden" name="concept" id="column" value="<?php echo $oldcolumnname; ?>">

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
                <textarea id="options" class="form-control" name="options"></textarea>
            </div>
        </div>
    </div>
    <p/>
    <input type="hidden" name="concept" id="concept" value="<?php echo $concept; ?>">





    <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input class="btn btn-success" type="Submit" value="Update column">
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