<?php require_once("./../../config/db.config.php"); ?>
<?php require_once("./../../config/dashboard.auth.php"); ?>
<?php include_once("./../../model/CategoryManager.php"); ?>
<?php hasPermission(["Admin"]); ?>



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


    <div id="main-content">
        <div class="dashboard__content">
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
                            <th align="left">Category ID</th>
                            <th align="left">Category Name</th>
                            <th align="center" width="100px">Action</th>

                    </thead>

                    <tbody>
                        <?php

                        $categoryList = $categoryManager->getAllCategories();

                        foreach ($categoryList as $row) {
                            $category_id = $row["category_id"];

                            echo "<tr>";
                            echo "<td width='150px'>{$row["category_id"]}</td>";
                            echo "<td>{$row["category_name"]}</td>";
                            echo "<td align='center'>
                                 <form method='POST'>
                                    <a class='button btn-primary' href='/epasale/dashboard/category/AddCategory.php?id={$category_id}'>Edit Info</a>
                                    <input type='text' name='category_id' value='{$category_id}'  hidden />
                                 </form>
                              </td>";
                            echo "</tr>";

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="/epasale/public/js/dashboard.js"></script>
</body>

</html>