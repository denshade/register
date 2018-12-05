<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";
$pdo = getConnectionFromSession();

function createCheckbox($label, $name)
{
    echo '<div class="row">
                        <div class="col-2">
                            <label>'.$label.'</label></div>
                        <div class="col">
                            <input class="form-control" type="checkbox" name="'.$name.'">
                        </div>
                    </div>';
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
            <div class="card-header">
                Creating a new user
            </div>
            <div class="card-body">

                <form action="usercreateret.php" method="post">
                    <div class="row">
                        <div class="col-2">
                            <label>Username</label></div>
                        <div class="col">
                            <input class="form-control" type="text" name="new_username">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <label>Password</label></div>
                        <div class="col">
                            <input class="form-control" type="password" name="new_password">
                        </div>
                    </div>
                    <?php createCheckbox("Create new concepts", "create");?>
                    <?php createCheckbox("Drop concepts", "drop");?>
                    <?php createCheckbox("Delete data", "delete");?>
                    <?php createCheckbox("Insert data", "insert");?>
                    <?php createCheckbox("Update data", "update");?>
                    <?php createCheckbox("Grant permissions", "grant");?>
                    <input class="btn btn-primary" type="submit" value="Create user"/>
                    <button class="btn btn-secondary" onclick="window.location.href = 'index.php';return false;">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>