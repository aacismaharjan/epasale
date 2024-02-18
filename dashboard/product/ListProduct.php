<?php require_once("./../../config/db.config.php"); ?>
<?php require_once("./../../config/dashboard.auth.php"); ?>
<?php include_once("./../../model/ProductManager.php"); ?>
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
        $productManager=new ProductManager($conn);
        
        if(isset($_POST["submit"])){
           $productManager->addProduct($_POST);
        }else if(isset($_POST["update"])) {
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
                        $product_id = $row["product_id"];
                        $product_image = "";
                        $photo_url = $row['product_photo_url'];

                        if ($row['product_photo_url']) {
                            $product_image = "<img src='/epasale/$photo_url' width='80px' height='80px' />";
                        }
                      

                        echo "<tr>";
                        echo "<td>{$row["product_id"]}</td>";
                        echo "<td>$product_image</td>";
                        echo "<td>{$row["product_name"]}</td>";
                        echo "<td>{$row["product_description"]}</td>";
                        echo "<td>{$row["unit_price"]}</td>";
                        echo "<td align='center'>{$row["is_active"]}</td>";
                        echo "<td>{$row["created_at"]}</td>";
                        echo "<td>{$row["category_name"]}</td>";
                        echo "<td align='center'>
                                     <form method='POST'>
                                        <a class='button btn-primary' href='/epasale/dashboard/product/AddProduct.php?id={$product_id}'>Edit Info</a>
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
</body>

</html>