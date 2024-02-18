<?php require_once("./config/db.config.php"); ?>
<?php require_once("./model/CartManager.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ePasal - Home Page</title>

    <!-- CSS Stylesheets Start -->
    <link rel="stylesheet" href="/epasale/public/css/style.css">
    <link rel="stylesheet" href="/epasale/public/css/cart.css">
    <!-- CSS Stylesheets End -->
</head>

<body>
    <!-- Includes header partial from ./includes/_header.php -->
    <?php include_once("includes/_header.php"); ?>

    

    <!-- Cart Start -->
    <div class="cart__section">
        <h3 class="cart__sectiontitle">Cart Container</h3>
        <?php
            $cartManager = new CartManager($conn);
            $cart = array();
            if(isset($_COOKIE["cart"])) {
                $cart = $cartManager->getProductsFromCarts($_COOKIE["cart"]);
            }else {
                echo "Your cart is empty.";
            }
        ?>
        <div class="cart__container">
            <?php
              foreach($cart as $product) {
                echo '
                <div class="cart product__card" data-pid="'. $product["product_id"] .'"  data-iscart="true">
                    <a class="cart__a" href="/epasale/product-detail.php?id=' . $product["product_id"] . '">
                        <img class="cart_product__img" src="/epasale/' . $product["product_photo_url"] . '" />
                    </a>
                    <div class="cart__info">
                        <a class="cart__a" href="/epasale/product-detail.php?id=' . $product["product_id"] . '">
                            <h3 class="cart__h3">' . $product["product_name"] . '</h3>
                        </a>

                        <div class="qtygroup">
                            <label>Qty: </label>
                            <button class="qtygroup__btn--dec">-</button>
                            <input type="number" min="1" max="10" class="qtygroup__input" value="' . $product["quantity"] . '" size="5" disabled />
                            <button class="qtygroup__btn--inc">+</button>
                        </div>

                        <p class="product-remove">
                            <button class="button btn--delete icon"><i class="fa fa-trash"></i></button>
                        </p>
                        <p><b class="price" id="price">Rs.' . $product["unit_price"] . '</b></p>
                    </div>
                </div>';
              }
            ?>

        </div>


        <div class="cart__btn">
            <a class="cart__a" href="/epasale/checkout.php?id=1" style="margin-right: 8px">
                <button class="button btn-primary">Proceed to Checkout</button>
            </a>

            <a class="cart__a" href="/epasale" >
                <button class="button">Cancel</button>
            </a>
        </div>
    </div>

    <!-- Cart End -->

    <!-- Includes footer partial from ./includes/_footer.php -->
    <?php include_once("includes/_footer.php"); ?>
</body>

</html>