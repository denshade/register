<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";

$conceptDao = new ConceptDao($pdo);
$concept = $_GET['concept'];
$id = $_GET['id'];
$conceptData = $conceptDao->getById($concept, $id);

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
        <div class="card" style="width: 80%;">
            <div class="card-header">
                Data form for <?php echo $concept; ?>
            </div>
            <div class="card-body">

                <form action="editformdataret.php">

                    <?php
                    echo '<input type="hidden" name="concept" value="'.$concept.'"/>';
                    echo '<input type="hidden" name="id" value="'.$id.'"/>';
                    foreach (array_slice($conceptDao->getAttributes($concept), 1) as $attribute) {
                        echo "<div class=\"row\"> <div class=\"col-2\">";
                        $value = $conceptData[$attribute->name];
                        echo "<label>$attribute->name</label></div><div class=\"col\">";
                        /**
                         * @var $attribute Attribute
                         */
                        if ($attribute->isBoolean())
                        {
                            $checked = "";
                            if ($value == 1){
                                $checked = "checked";
                            }
                            echo '<input type="checkbox" class="form-control" name="' . $attribute->name.'" '.$checked.'>';
                        } else if ($attribute->isInt()) {
                            echo '<input type="number" class="form-control" name="' . $attribute->name . '" value='.$value.'>';
                        } else if ($attribute->isEnum()) {
                            echo '<select class="form-control" name="'.$attribute->name .'">';
                            foreach ($attribute->getOptions() as $option) {
                                $selected = "";
                                if ($option == $option) {
                                    $selected = "selected";
                                }
                                echo '<option $selected value="' . $option . '">' . $option . '</option>';
                            }
                            echo '</select>';
                        } else if ($attribute->isVarchar() || $attribute->isText())
                        {
                            echo '<input class="form-control" type="text" name="' . $attribute->name . '" value="'.$value.'">';
                        }else if ($attribute->isDouble())
                        {
                            echo '<input class="form-control" type="number" step="any" name="' . $attribute->name . '" value="'.$value.'">';
                        }
                        else {
                            throw new Exception("Unknown attribute type" . $attribute->type);
                        }
                        echo "</div></div>";
                    }
                    ?>
                    <hr/>
                    <input class="btn btn-primary" type="submit" value="Save"/>
                    <button class="btn btn-secondary" onclick="window.location.href = 'index.php';return false;">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>