<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";

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
                    <div class="row">
                        <div class="col-2">
                            <label>Create new concepts</label></div>
                        <div class="col">
                            <input class="form-control" type="checkbox" name="create">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <label>Drop concepts</label></div>
                        <div class="col">
                            <input class="form-control" type="checkbox" name="drop">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <label>Delete data</label></div>
                        <div class="col">
                            <input class="form-control" type="checkbox" name="delete">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <label>Insert data</label></div>
                        <div class="col">
                            <input class="form-control" type="checkbox" name="insert">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <label>Update data</label></div>
                        <div class="col">
                            <input class="form-control" type="checkbox" name="update">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <label>Grant permissions</label></div>
                        <div class="col">
                            <input class="form-control" type="checkbox" name="grant">
                        </div>
                    </div>
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