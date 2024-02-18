<?php 
require_once("./config/db.config.php"); 
require_once("./model/ProductManager.php");
?>
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
<?php


// Performs logout action
if (isset($_GET["action"]) && $_GET["action"] === "logout") {
    session_destroy();
    unset($_SESSION["user_id"]);
    unset($_SESSION["email"]);
    unset($_SESSION["fullname"]);
    header("Location: /epasale");
}

if (isset($_POST["submit"])) {
    $_SESSION["latitude"] = $_POST["latitude"];
    $_SESSION["longitude"] = $_POST["longitude"];
}


function getDistance($lat, $lon) {
    if (isset($_SESSION["latitude"]) && isset($_SESSION["longitude"])) {
        $source = new GeoLocation($_SESSION["latitude"], $_SESSION["longitude"]);
        $target = new GeoLocation($lat, $lon);

        $locator = new Locator($source, $target);
        return $locator->showDistance();
    }
}
?>

<body>

    <!-- Includes header partial from ./includes/_header.php -->
    <?php include_once("includes/_header.php"); ?>

    <!-- 
        Products Start
        .seller__container contains all .seller(s) sections
        .seller contains .seller__profile and all seller__card product__card sections
     -->


    <div class="seller__container">
        <?php
        $productManager = new ProductManager($conn);
        $sellers =$productManager->getProductsBySellers(null, 50);


        foreach($sellers as $seller) {
            $productsHTML = "";

            foreach($seller["products"] as $product) {
                $productsHTML .= '  
                <div class="seller__card product__card" data-pid="'. $product["product_id"] .'">
                    <a class="seller__a" href="/epasale/product-detail.php?id='. $product["product_id"] .'">
                        <img class="qtygroup__cardimg" src="'. $product["product_photo_url"] .'" alt="Productimage">
                    </a>
                    <div class="seller__cardbody">
                        <a class="seller__a" href="/epasale/product-detail.php?id='. $product["product_id"] .'">
                            <h3 class="seller__cardtitle">'. $product["product_name"] .'</h3>
                        </a>
                        <p class="seller__cardsubtitle">NRs. '. $product["unit_price"] .'</p>
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

            echo '
            <div class="seller">
                <div class="seller__info">
                    <div class="seller__profile">
                        <a class="seller__a" href="/epasale/seller-page.php?id='. $seller["user_id"] .'">
                            <img class="seller__profile__avatar" src="/epasale/public/img/shops/shop.jpg" width="40px" />
                        </a>
                        <div class="seller__profile-content">
                            <h3>'. $seller["fname"] . ' ' . $seller['lname']  .'</h3>
                            <h4>'. $seller["province"] .' '. getDistance(27.72407583495227, 85.36264737728318) .'</h4>
                        </div>
                    </div>
                    <a href="/epasale/seller-page.php?id='. $seller["user_id"] .'" class="seller__a">
                        <button class="button button-small btn-primary">See More</button>
                    </a>
                </div>
        
                <div class="seller__content"> '. $productsHTML .' </div>
            </div>';
        }
        ?>


    </div>
    <!-- Includes footer partial from ./includes/_footer.php -->
    <?php include_once("includes/_footer.php"); ?>
    <script>
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        // Successful retrieval of user's location
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        var formData = new FormData();

                        formData.append("latitude", latitude);
                        formData.append("longitude", longitude);
                        formData.append("submit", "location");

                        fetch("/epasale/index.php", {
                            method: "POST",
                            body: formData,
                            headers: {
                                // "Content-Type": "application/x-www-form-urlencoded",
                            }
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error("Network response not ok");
                            }
                            return response.text();
                        })
                            .then((data) => {
                                window.location = "/epasale/index.php";
                            }).catch(error => {
                                console.error("Fetch error:", error);
                            })

                        console.log("Latitude: " + latitude + ", Longitude: " + longitude);

                        // You can use the coordinates in your application
                    },
                    function (error) {
                        // Handle errors (e.g., user denied permission)
                        console.error("Error getting user location:", error.message);
                    }
                );
            } else {
                // Geolocation is not supported by the browser
                console.error("Geolocation is not supported by your browser.");
            }
        }

        // Call the function to get the user's location
        <?php if (!isset($_SESSION["latitude"]) || !isset($_SESSION["longitude"])) {
            echo ("getUserLocation();");
        } ?>
    </script>
</body>

</html>