<?php require_once("./../../config/db.config.php"); ?>
<?php require_once("./../../config/dashboard.auth.php"); ?>

<?php include_once("./../../model/CategoryManager.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/epasale/public/css/style.css" />
    <link rel="stylesheet" href="/epasale/public/css/dashboard.css" />
</head>



<body>
    <?php include_once("./../../includes/_sidenav.php"); ?>

    <?php include_once("./../../includes/_header.dash.php"); ?>
    
    <div class="dashboard__content" id="main-content">
        <div class="alert-container"></div>
        <?php
        $categoryManager = new CategoryManager($conn);

        if (isset($_POST['submit']))
            $categoryManager->addCategory($_POST);

        if (isset($_POST['update']))
            $categoryManager->updateCategory($_POST);
        ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                    <th align="left">User ID</th>
                        <th align="left">User Photo</th>
                        <th align="left">First Name</th>
                        <th align="left">Last Name</th>
                        <th align="left">Email</th>
                        <th align="left">Contact No</th>
                        <th align="left">Gender</th>
                        <th align="left">Address ID</th>
                        <th align="left">Created At</th>
                        <th align="left">Is Active</th>
    </tr>

    </thead>

                <tbody>
                    <?php

                    $adminList = $categoryManager->getAllUser(1);

                    foreach ( $adminList as $row) {
                        $admin_id = $row["user_id"];

                        echo "<tr>";
                        echo "<td>{$row["user_id"]}</td>";
                        echo "<td><img src='/epasale/public/img/user/default.jpg' width='50px' alt='User Profile'>
                        </td>";
                        echo "<td>{$row["fname"]}</td>";
                        echo "<td>{$row["lname"]}</td>";
                        echo "<td>{$row["email"]}</td>";
                        echo "<td>{$row["contact_no"]}</td>";
                        echo "<td>{$row["gender"]}</td>";
                        echo "<td>{$row["address_id"]}</td>";
                        echo "<td>{$row["created_at"]}</td>";
                        echo "<td>{$row["is_active"]}</td>";
                        echo "</tr>";

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>