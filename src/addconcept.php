<?php
require_once "daos/ConceptDao.php";
require_once "../settings.php";

require "connection.php";

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
        <form class="needs-validation form-horizontal" action="addconceptret.php">
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Name of the new concept</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="concept" required pattern="[a-zA-Z][a-zA-Z0-9_]*" oninput="removeSpaces('concept');" id="concept" placeholder="Name of the new concept" maxlength="255">
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Create new concept">
            <button class="btn btn-secondary" onclick='window.location.href="index.php";return false;'>Cancel</button>
        </form>
</body>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</html>