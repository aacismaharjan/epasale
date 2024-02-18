<?php require_once("./config/db.config.php"); ?>
<?php require_once("./model/OrderManager.php"); ?>
<?php require_once("./model/UserManager.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Information</title>

    <!-- CSS Stylesheets Start -->
    <link rel="stylesheet" href="/epasale/public/css/style.css">
    <link rel="stylesheet" href="/epasale/public/css/order.css">
    <!-- CSS Stylesheets End -->
</head>

<body>
    <!-- Includes header partial from ./includes/_header.php -->
    <?php include_once("includes/_header.php"); ?>

    <br />
    <div class="form__container">
        <div class="form form--full shadow">
            <!-- Fetch a Record -->
            <?php
            $shop = "";
            $userID = "";

            if (isset($_POST["submit"])) {
                $userManager = new UserManager($conn);
                $userManager->updateShopOrCreate($_POST, $_FILES);
                // Update shop information
                // Add code to update shop information based on $_POST data
            
            }

            if (isset($_SESSION["user_id"])) {
                $userID = (int) $_SESSION["user_id"];
                $userManager = new UserManager($conn);
                $shop = $userManager->getShopById($userID);
            }
            ?>

            <form method="POST" class="form__wrapper" id="form-shop" enctype="multipart/form-data">
                <h3 class="form__h1">Shop Information</h3>
                <?php echo "<input value='{$userID}' name='userID' hidden />"; ?>

                <fieldset>
                    <legend>Shop Details</legend>
                    <div class="form-group">
                        <label class="form-label" for="shop_name">Shop Name *</label>
                        <input class="form-input" type="text" placeholder="Enter shop name" name="shop_name"
                            id="shop_name" value="<?php echo $shop && $shop['shop_name'] ? $shop['shop_name'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="shop_photo_url">Shop Photo *</label>
                        <input class="form-input" type="file" placeholder="Enter shop photo" name="shop_photo_url"
                            id="shop_photo_url"
                            value="<?php echo $shop && $shop['shop_photo_url'] ? $shop['shop_photo_url'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="shop_city">City *</label>
                        <input class="form-input" type="text" placeholder="Enter city" name="shop_city" id="shop_city"
                            value="<?php echo $shop && $shop['shop_city'] ? $shop['shop_city'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="shop_address">Address *</label>
                        <input class="form-input" type="text" placeholder="Enter address" name="shop_address"
                            id="shop_address"
                            value="<?php echo $shop && $shop['shop_address'] ? $shop['shop_address'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="shop_lon">Longitude *</label>
                        <input class="form-input" type="text" placeholder="Enter longitude" name="shop_lon"
                            id="shop_lon" value="<?php echo $shop && $shop['shop_lon'] ? $shop['shop_lon'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="shop_lat">Latitude *</label>
                        <input class="form-input" type="text" placeholder="Enter latitude" name="shop_lat" id="shop_lat"
                            value="<?php echo $shop && $shop['shop_lat'] ? $shop['shop_lat'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="shop_contact_no">Contact Number *</label>
                        <input class="form-input" type="text" placeholder="Enter contact number" name="shop_contact_no"
                            id="shop_contact_no"
                            value="<?php echo $shop && $shop['shop_contact_no'] ? $shop['shop_contact_no'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="is_verified">Shop Verification</label>
                        <input class="form-input" type="text" name="is_verified" disabled id="is_verified"
                            value="<?php echo $shop && $shop['is_verified'] ? "VERIFIED" : 'UNVERIFIED'; ?>">
                    </div>
                </fieldset>

                <button type="submit" name="submit">
                    Update Shop Information
                </button>
            </form>
        </div>

        <br />

        <!-- Includes footer partial from ./includes/_footer.php -->
        <?php include_once("includes/_footer.php"); ?>
    </div>
</body>

</html>