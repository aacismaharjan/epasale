<?php require_once("./../../config/db.config.php"); ?>
<?php require_once("./../../config/dashboard.auth.php"); ?>
<?php include_once("./../../model/ProductManager.php"); ?>
<?php hasPermission(["Seller"]); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/public/css/style.css" />
    <link rel="stylesheet" href="/public/css/dashboard.css" />
</head>


<body>
    <?php include_once("./../../includes/_sidenav.php"); ?>

    <?php include_once("./../../includes/_header.dash.php"); ?>




    <div id="main-content">
        <div class="dashboard__content">


            <?php
            $productManager = new ProductManager($conn);

            if (isset($_POST["submit"])) {
                $productManager->addProduct($_POST);
            } else if (isset($_POST["update"])) {
                $productManager->updateProduct($_POST);
            }

            ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th align="left">Product ID</th>
                            <th align="left">Photo</th>
                            <th align="left" width="240px">Product Name</th>
                            <th align="left" width="340px">Product Description</th>
                            <th align="left">Unit Price(Rs.)</th>
                            <th align="center">Status</th>
                            <th align="left">Created At</th>
                            <th align="left">Category</th>
                            <th align="center" width="100px">Action</th>
                    </thead>

                    <tbody>
                        <?php
                        $productManager = new ProductManager($conn);
                        $productList = $productManager->getAllProducts($_SESSION["user_id"]);

                        foreach ($productList as $row) {
                            $active_status = $row["is_active"] ? "Active" : "Not Active";

                            $product_id = $row["product_id"];
                            $product_image = "";
                            $photo_url = $row['product_photo_url'];

                            if ($row['product_photo_url']) {
                                $product_image = "<img src='/$photo_url' width='80px' height='80px' />";
                            }


                            echo "<tr>";
                            echo "<td>{$row["product_id"]}</td>";
                            echo "<td>$product_image</td>";
                            echo "<td>{$row["product_name"]}</td>";
                            echo "<td>{$row["product_description"]}</td>";
                            echo "<td>{$row["unit_price"]}</td>";
                            echo "<td><span class='table__badge'>{$active_status}</span></td>";
                            echo "<td>{$row["created_at"]}</td>";
                            echo "<td><span class='table__badge'>{$row["category_name"]}</span></td>";
                            echo "<td align='center'>
                                     <form method='POST'>
                                        <a class='button btn-primary' href='/dashboard/product/AddProduct.php?id={$product_id}'>Edit Info</a>
                                        <input type='text' name='product_id' value='{$product_id}'  hidden />
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
    <script src="/public/js/dashboard.js"></script>
</body>

</html>