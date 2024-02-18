<?php require_once("./config/db.config.php"); ?>
<?php require_once("./model/OrderManager.php"); ?>
<?php require_once("./model/UserManager.php"); ?>
<?php hasPermission(["User"]); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

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
        <div class="form shadow">
            <!-- Fetch a Record -->
            <?php
            $record = "";
            $userID = "";

            if (isset($_POST["submit"])) {
                $userManager = new UserManager($conn);
                $userManager->changePassword($_POST);
            }

            if (isset($_SESSION["user_id"])) {
                $userID = (int) $_SESSION["user_id"];
            }
            ?>

            <form method="POST" action="/epasale/change-password.php" class="form__wrapper" id="form-password">
                <h3 class="form__h1">Change Password</h3>
                <?php echo "<input value='{$userID}' name='userID' hidden />"; ?>

                <div class="form-group">
                    <label class="form-label" for="password">Current Password *</label>
                    <input class="form-input" type="password" placeholder="Enter your current password" name="password" id="password" required>
                    <span class="text-error"></span>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password1">New Password *</label>
                    <input class="form-input" type="password" placeholder="Enter your new password" name="password1" id="password1" required>
                    <span class="text-error"></span>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password2">Confirm New Password *</label>
                    <input class="form-input" type="password" placeholder="Confirm your new password" name="password2" id="password2" required>
                    <span class="text-error"></span>
                </div>

                <button type="submit" name="submit">Change Password</button>
            </form>
        </div>

        <br />

        <!-- Includes footer partial from ./includes/_footer.php -->
        <?php include_once("includes/_footer.php"); ?>

    </div>
</body>

</html>
