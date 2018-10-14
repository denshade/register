<?php
require_once "ConceptDao.php";
require_once "../settings.php";

require "connection.php";
$concept = $_GET["concept"];
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
        <div class="card" style="width: 80%;">
            <div class="card-header">
                Data form for <?php echo $concept; ?>
            </div>
            <div class="card-body">

                <form action="dataentryformret.php">

                    <?php
                    echo '<input type="hidden" name="concept" value="'.$concept.'"/>';
                    foreach (array_slice($conceptDao->getAttributes($concept), 1) as $attribute) {
                        echo "<div class=\"row\"> <div class=\"col-2\">";

                        /**
                         * @var Attribute $attribute
                         */
                        echo "<label>$attribute->name</label></div><div class=\"col\">";
                        if ($attribute->isBoolean())
                        {
                            echo '<input type="checkbox" class="form-control" name="' . $attribute->name.'">';
                        } else if ($attribute->isInt()) {
                            echo '<input type="number" class="form-control" name="' . $attribute->name . '">';
                        } else if ($attribute->isEnum()) {
                            echo '<select class="form-control" name="'.$attribute->name .'">';
                            foreach ($attribute->getOptions() as $option) {
                                echo '<option value="' . $option . '">' . $option . '</option>';
                            }
                            echo '</select>';
                        } else if ($attribute->isVarchar() || $attribute->isText())
                        {
                            echo '<input class="form-control" type="text" name="' . $attribute->name . '">';
                        }
                        else if ($attribute->isDouble())
                        {
                            echo '<input class="form-control" type="text"  name="' . $attribute->name . '">';
                        }
                        else {
                            var_dump($attribute->type);
                        }
                        echo "</div></div>";
                    }
                    ?>
                    <input class="btn btn-primary" type="submit" value="Save"/>
                    <button class="btn btn-secondary" onclick="window.location.href = 'index.php';return false;">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>