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
    

    <div class="main dashboard__content" id="main-content">
        <?php
        $product_id = "";
        $record = "";


        if (isset($_GET["id"])) {
            $product_id = $_GET["id"];
            $productManager = new ProductManager($conn);
            $record = $productManager->getProductById($product_id);
        }

        ?>


        <form method="POST" action="/epasale/dashboard/product/ListProduct.php" class="product-form form__wrapper"
            id="form-category" ENCTYPE="multipart/form-data">
            <h3>Product Information</h3>

            <?php echo "<input type='text' value='{$product_id}' name='product_id' hidden />"; ?>

            <input hidden type="text" name="seller_id" value='<?php echo $_SESSION["user_id"]; ?>' />
            <input hidden type="text" name="product_id" value='<?php echo $_GET["id"]; ?>' />

            <div class="form-group">
                <label class="form-label" for="product_photo_url">Product Photo *</label>
                <input class="form-input" type="file" placeholder="Eg: Burger" name="product_photo_url"
                    id="product_photo_url">
                <span class="text-error"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="product_name">Product Name *</label>
                <input class="form-input" type="text" placeholder="Eg: Burger" name="product_name" id="product_name"
                    value="<?php echo $product_id && $record['product_name'] ? $record['product_name'] : ''; ?>">
                <span class="text-error"></span>
            </div>



            <div class="form-group">
                <label class="form-label" for="category_id">Category *</label>
                <select class="form-input" name="category_id" id="category_id">
                    <option value="">--Select--</option>
                    <?php

                    //  Fetch products from database
                    $sql = "SELECT * FROM tbl_categories";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $category_id = $row["category_id"];
                            $category_name = $row["category_name"];

                            if ($product_id && $record["category_id"]) {
                                $selected = $category_id == $record["category_id"] ? "selected" : "";
                                echo "<option value='$category_id' $selected >$category_name</option>";
                            } else {
                                echo "<option value='$category_id' >$category_name</option>";
                            }
                        }
                    }
                    ?>
                </select>
                <span class="text-error"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="product_description">Description *</label>
                <textarea class="form-input" type="text" placeholder="Eg: Write product description..." rows="3"
                    name="product_description"
                    id="product_description"><?php echo ($product_id && $record['product_description'] ? trim($record['product_description']) : ''); ?></textarea>
                <span class="text-error"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="is_active">Status *</label>
                <select class="form-input" name="is_active" id="is_active">
                    <option value="">--Select--</option>
                    <option value="1" <?php echo $product_id && $record['is_active'] === 1 ? "selected" : ""; ?>>
                        Enable
                    </option>
                    <option value="0" <?php echo $product_id && $record['is_active'] === 0 ? "selected" : ""; ?>>
                        Disable</option>
                </select>
                <span class="text-error"></span>
            </div>


            <div class="form-group">
                <label class="form-label" for="unit_price">Unit Price *</label>
                <input class="form-input" type="text" placeholder="Eg: 150" name="unit_price" id="unit_price"
                    value="<?php echo $product_id && $record['unit_price'] ? $record['unit_price'] : ''; ?>">
                <span class="text-error"></span>
            </div>

            <button type="submit" name="<?php echo $product_id && $record ? "update" : 'submit'; ?>">
                <?php echo $product_id && $record ? "Update Product" : 'Add Product'; ?>
            </button>
        </form>
    </div>

    <script defer src="./js/script.js"></script>
</body>

</html>nput