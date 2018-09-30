<?php
require_once "ConceptDao.php";
require_once "../settings.php";

try {
    $pdo = getConnection();
    $conceptDao = new ConceptDao($pdo);
    $concept = $_GET['concept'];
} catch (PDOException $exception) {
    header("Location: login.php");
    return;
    //redirect to login.php
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
        <div class="card" style="width: 80%;">
            <div class="card-body">

                <form action="dataentryformret.php">

                    <?php
                    echo '<input type="hidden" name="concept" value="'.$concept.'"/>';
                    foreach (array_slice($conceptDao->getAttributes($concept), 1) as $attribute) {
                        echo "<div class=\"row\"> <div class=\"col-2\">";

                        echo "<label>$attribute->name</label></div><div class=\"col\">";
                        if ($attribute->isBoolean())
                        {
                            echo '<input type="checkbox" name="' . $attribute->name.'">';
                        } else if ($attribute->isInt()) {
                            echo '<input type="number" name="' . $attribute->name . '">';
                        } else if ($attribute->isEnum()) {
                            echo '<select name="'.$attribute->name .'">';
                            foreach ($attribute->getOptions() as $option) {
                                echo '<option value="' . $option . '">' . $option . '</option>';
                            }
                            echo '</select>';
                        } else if ($attribute->isVarchar())
                        {
                            echo '<input type="text" name="' . $attribute->name . '">';
                        } else {
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