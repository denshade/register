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
$concept = $_GET["concept"];

?>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="../css/main.css"/>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Register</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <br/>

    <div class="container-fluid">
<form class="form-horizontal">
    <div class="form-group">
        <label for="name" class="cols-sm-2 control-label">Name of the new column</label>
        <div class="cols-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter the name of column">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="cols-sm-2 control-label">Type of the new column</label>
        <div class="cols-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <select class="form-control">
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

    <div class="form-group">
        <label for="name" class="cols-sm-2 control-label">Required</label>
        <div class="cols-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input type="checkbox" value="Required">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="cols-sm-10">
            <div class="input-group">
                <input class="btn btn-success" type="Submit" value="Add column">
            </div>
        </div>
    </div>


</form>

        <table class="display nowrap dataTable dtr-inline collapsed" id="concept">
            <thead>
            <tr>
                <th>Name</th><th>Type</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $attributes = $conceptDao->getAttributes($concept);
            foreach ($attributes as $attribute)
            {
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