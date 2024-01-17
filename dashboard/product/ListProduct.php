<?php require_once("./../../utils/connection.php"); ?>
<?php include_once("./../../model/ProductManager.php"); ?>
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
                    $productList = $productManager->getAllProducts();

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