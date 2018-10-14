<?php
require_once "UserDao.php";
require_once "../settings.php";

require "connection.php";

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
                <th>Username</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($userDao->getUsers() as $dataRow) {
                echo "<tr><td>";
                echo "$dataRow";
                echo "</td></tr>";

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