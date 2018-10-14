<?php
require_once "ConceptDao.php";
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
    <h1><div class="alert alert-info">Export database</div></h1>
    <button class="btn btn-success" onclick='window.location.href="exportschema.php";'>Export database schema (no data)</button>
    <hr/>
    <h1><div class="alert alert-info">Import database</div></h1>

</div>

</body>
</html>