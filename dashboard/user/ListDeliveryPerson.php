<?php require_once("./../../utils/connection.php"); ?>
<?php include_once("./../../model/CategoryManager.php"); ?>
<?php include_once("./../../model/UserManager.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Page</title>
    <link rel="stylesheet" href="/epasale/public/css/global.css" />
    <link rel="stylesheet" href="/epasale/public/css/dashboard.css" /> <!-- google font start -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto+Condensed:wght@300&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>
        body {
            background: #eeeeee;
        }
    </style>
</head>


<body>
    <?php include_once("./../_sidenav.php"); ?>
    <div class="dashboard__content">
        <div class="alert-container"></div>
        <?php
        $categoryManager = new CategoryManager($conn);
        $userManager = new UserManager($conn);

        if (isset($_POST['submit']))
            $categoryManager->addCategory($_POST);

        if (isset($_POST['update']))
            $categoryManager->updateCategory($_POST);

        if (isset($_POST["is_active"])) {
            $userManager->updateUser($_POST["user_id"], "is_active", $_POST["is_active"]);
        }
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

                        <th align="center" width="100px">Action</th>

                </thead>

                <tbody>
                    <?php

                    $deliveryPersonList = $categoryManager->getAllUser(4);

                    foreach ($deliveryPersonList as $row) {
                        $deliveryPerson_id = $row["user_id"];

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
                        echo '<td>
                                <form method="post">
                                    <input name="user_id" value="' . $row["user_id"] . '" hidden />
                                    <select name="is_active" onchange="this.parentElement.submit();">
                                        <option value="0" ' . ($row["is_active"] == "0" ? "selected=true" : "") . ' >Block</option>
                                        <option value="1" ' . ($row["is_active"] == "1" ? "selected=true" : "") . ' >Unblock</option>
                                    </select>
                                </form>
                            </td>';
                        echo "</tr>";

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>