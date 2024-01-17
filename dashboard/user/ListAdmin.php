<?php require_once("./../../utils/connection.php"); ?>
<?php include_once("./../../model/CategoryManager.php"); ?>

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
                        <th align="left">Action</th>
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
                        echo "<td align='center'>
                                 <form method='POST'>
                                    <a class='button btn-primary' href='/epasale/dashboard/category/AddCategory.php?id={$admin_id}'>Edit Info</a>
                                    <input type='text' name='category_id' value='{$admin_id}'  hidden />
                                 </form>
                              </td>";
                        echo "</tr>";

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>