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
    $product = $productManager->getProductById($_GET["id"]);
    ?>


    <div class="just">
        <div class="prddetail__wrapper">
            <div class="prddetail">
                <img src="<?php echo $product["product_photo_url"]; ?>" class="prddetail__img" />
                <div class="prddetail__info product__card" data-pid="<?php echo $product["product_id"];  ?>">
                    <h3 class="prddetail__infotitle seller__cardtitle">
                        <?php echo $product["product_name"]; ?>
                    </h3>
                    <h4 class="prddetail__infodesc">Rs.
                        <?php echo $product["unit_price"]; ?>
                    </h4>
                    <div class="qtygroup">
                        <button class="qtygroup__btn--dec">-</button>
                        <input type="number" min="1" max="10" class="qtygroup__input" value="1" size="5" disabled />
                        <button class="qtygroup__btn--inc">+</button>
                    </div>
                    <div class="prddetail__btngroup">
                        <button class="button btn-primary seller__btn--buy">Buy Now</button>
                        <button class="button btn-primary seller__btn--cart">Add To Cart</button>
                    </div>

                    <br />
                    <p style="line-height: 1.6">
                        <?php echo $product["product_description"]; ?>
                    </p>
                    <br />



                    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <?php
                            if ($product["is_active"]) {
                                echo "<span title='Product Available' class='badge badge-not-empty'></span>";
                            } else {
                                echo "<span title='Product Not Available'  class='badge badge-empty'></span>";
                            }
                        ?>

                        <a class="link badge"
                            href="/epasale/search.php?category=<?php echo $product["category_name"]; ?>">
                            <?php echo $product["category_name"]; ?>
                        </a>

                        <a class="link badge"
                            href="/epasale/seller-page.php?id=<?php echo $product["user_id"]; ?>">
                            <?php echo $product["shop_name"]; ?>
                        </a>
                    </div>

                    <div style="color: #ddd; margin-top: 16px; font-size: 14px;">
                        <?php echo date("Y/m/d", strtotime($product["created_at"])); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Includes footer partial from ./includes/_footer.php -->
    <?php include_once("includes/_footer.php"); ?>
</body>

</html>