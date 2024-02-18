<?php require_once("./../../config/db.config.php"); ?>
<?php require_once("./../../config/dashboard.auth.php"); ?>
<?php include_once("./../../model/CategoryManager.php"); ?>
<?php include_once("./../../model/UserManager.php"); ?>
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
            $userManager = new UserManager($conn);

            if (isset($_POST["is_active"])) {
                $userManager->patchShop($_POST["user_id"], "is_active", $_POST["is_active"]);
            }

            if (isset($_POST["is_verified"])) {
                $userManager->patchShop($_POST["user_id"], "is_verified", $_POST["is_verified"]);
            }
            ?>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th align="left">Shop ID</th>
                            <th align="left">User ID</th>
                            <th align="left">Full Name</th>
                            <th align="left">Shop Name</th>
                            <th align="left">City</th>
                            <th align="left">Address</th>
                            <th align="left">Contact</th>
                            <th align="left">Longitude</th>
                            <th align="left">Latitude</th>
                            <th align="left">Is Verified</th>
                            <th align="center" width="100px">Action</th>

                    </thead>

                    <tbody>
                        <?php

                        $shopManager = new UserManager($conn);
                        $shopList = $shopManager->getAllShop();

                        foreach ($shopList as $row) {
                            $customer_id = $row["user_id"];

                            echo "<tr>";
                            echo "<td>{$row["shop_id"]}</td>";
                            echo "<td>{$row["user_id"]}</td>";
                            echo "<td><img src='/epasale/" . $row["user_photo_url"] . "' width='50px' alt='User Profile'>&nbsp;{$row["fname"]}</td>";
                            echo "<td><img src='/epasale/" . $row["shop_photo_url"] . "' width='50px' alt='User Profile'>&nbsp;{$row["shop_name"]}</td>";
                            echo "<td>{$row["shop_city"]}</td>";
                            echo "<td>{$row["shop_address"]}</td>";
                            echo "<td>{$row["shop_contact_no"]}</td>";
                            echo "<td>{$row["shop_lon"]}</td>";
                            echo "<td>{$row["shop_lat"]}</td>";
                            echo '<td>
                            <form method="post">
                                <input name="user_id" value="' . $row["user_id"] . '" hidden />
                                <select name="is_verified" onchange="this.parentElement.submit();">
                                    <option value="0" ' . ($row["is_verified"] == "0" ? "selected=true" : "") . ' >Unverified</option>
                                    <option value="1" ' . ($row["is_verified"] == "1" ? "selected=true" : "") . ' >Verified</option>
                                </select>
                            </form>
                        </td>';
                            echo '<td>
                                <form method="post">
                                    <input name="user_id" value="' . $row["user_id"] . '" hidden />
                                    <select name="is_active" onchange="this.parentElement.submit();">
                                        <option value="0" ' . ($row["is_active"] == "0" ? "selected=true" : "") . ' >Disabled</option>
                                        <option value="1" ' . ($row["is_active"] == "1" ? "selected=true" : "") . ' >Enabled</option>
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
    </div>
    <script src="/epasale/public/js/dashboard.js"></script>
</body>

</html>