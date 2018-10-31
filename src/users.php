<?php
require_once "daos/UserDao.php";
require_once "../settings.php";

require "connection.php";
$pdo = getConnectionFromSession();
$userDao = new UserDao($pdo);
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
        <h1>
            The available users
        </h1>
        <table class="display nowrap dataTable dtr-inline collapsed" id="usernames">
            <thead>
            <tr>
                <th>Username</th><th><!-- Buttons --></th>
            </tr>
            </thead>
            <tbody>
            <?php
            try {
                foreach ($userDao->getUsers() as $dataRow) {
                    echo "<tr>";
                    echo "<td>";
                    echo "$dataRow";
                    echo "</td>";
                    echo "<td>";
                    echo "<form style='display:inline' action='deleteuserret.php'><input type='submit' class='btn btn-danger btn-sm' value='X'/><input type='hidden' name='user' value='$dataRow'></form>";
                    echo "</td>";
                    echo "</tr>";

                }
            } catch (Exception $e)
            {
                require_once "ErrorView.php";
                ErrorView::showError($e);
            }
            ?>
            </tbody>
        </table>
        <button class="btn btn-success" onclick='window.location.href="create_user.php";'>Create new user</button>
        <script>$('#usernames').DataTable({paging: false});</script>


    </div>
</div>
</body>
</html>