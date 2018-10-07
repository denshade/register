<?php
require_once "ConceptDao.php";
require_once "../settings.php";

try {
    $pdo = getConnection();
} catch (PDOException $exception)
{
    http_redirect("login.php");
    //redirect to login.php
}
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
        <form class="form-horizontal" action="addconceptret.php">
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Name of the new concept</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="concept" onkeypress="removeSpaces('concept')" id="concept" placeholder="Name of the new concept" maxlength="255">
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Create new concept">
            <button class="btn btn-secondary" onclick='window.location.href="index.php";return false;'>Cancel</button>
        </form>
</body>
</html>