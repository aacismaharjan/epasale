<?php
require_once("./model/ProductManager.php");
require_once("./config/db.config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ePasal - Home Page</title>

    <!-- CSS Stylesheets Start -->
    <link rel="stylesheet" href="/epasale/public/css/style.css">
    <!-- CSS Stylesheets End -->

</head>

<body>
    <!-- Includes header partial from ./includes/_header.php -->
    <?php include_once("includes/_header.php"); ?>

    <?php
    $productManager = new ProductManager($conn);
    $products = $productManager->getProducts($_GET["id"]);
    $seller = $productManager->getSeller($_GET["id"]);

    $productsHTML = "";

    foreach ($products as $product) {
        $productsHTML .= '  
        <div class="seller__card product__card" data-pid="'. $product["product_id"] .'">
            <a class="seller__a" href="/epasale/product-detail.php?id=' . $product["product_id"] . '">
                <img class="qtygroup__cardimg" src="' . $product["product_photo_url"] . '" alt="Productimage">
            </a>
            <div class="seller__cardbody">
                <a class="seller__a" href="/epasale/product-detail.php?id=' . $product["product_id"] . '">
                    <h3 class="seller__cardtitle">' . $product["product_name"] . '</h3>
                </a>
                <p class="seller__cardsubtitle">NRs. ' . $product["unit_price"] . '</p>
                <div class="qtygroup">
                    <label>Qty: </label>
                    <button class="qtygroup__btn--dec">-</button>
                    <input type="number" min="1" max="10" class="qtygroup__input" value="1" size="5" disabled />
                    <button class="qtygroup__btn--inc">+</button>
                </div>
                <button class="seller__btn--cart" type="button">Add to Cart</button>
            </div>
        </div>';
    }
    ?>


    <div class="sellerfullpage">
        <div class="seller_detail">
            <div class="sp-detail">
                <div class="seller__profile">
                    <img src="<?php echo $seller["shop_photo_url"]; ?>" alt="logo" style="object-fit: cover;">


                    <?php

                    $lat = $seller["shop_lat"];
                    $lon = $seller["shop_lon"];
                    $name = $seller["shop_name"];

$mapsUrl = "https://www.google.com/maps/search/?q=$lat,$lon";
?>

                    <div class="seller__profileinfo">
                        <h3><?php echo $seller["shop_name"]; ?></h3>
                        <p><?php echo $seller["shop_address"] . ", " . $seller["shop_city"]; ?></p>
                    </div>
                </div>
            </div>

        </div>

        <div class="seller__content" style="flex-wrap: wrap; ">
            <?php echo $productsHTML; ?>
        </div>
    </div>

    <!-- Includes footer partial from ./includes/_footer.php -->
    <?php include_once("includes/_footer.php"); ?>
</body>
<!-- makes sure the js code runs after html is parsed -->

</html>