<?php require_once("./config/db.config.php"); ?>
<?php require_once("./model/OrderManager.php"); ?>
<?php require_once("./model/UserManager.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

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
            $record = "";
            $userID = "";

            if (isset($_POST["submit"])) {
                $userManager = new UserManager($conn);
                $userManager->updateUser($_POST, $_FILES);
            }

            if (isset($_SESSION["user_id"])) {
                $userID = (int) $_SESSION["user_id"];
                $userManager = new UserManager($conn);
                $record = $userManager->getUserById($_SESSION["user_id"]);
            }
            ?>

            <form method="POST" action="/epasale/my-details.php" class="form__wrapper" id="form-user"
                ENCTYPE="multipart/form-data">
                <h3 class="form__h1">My Information</h3>
                <?php echo "<input value='{$userID}' name='userID' hidden />"; ?>

                <fieldset>
                    <legend>Personal Information</legend>
                    <div class="form-group">
                        <label class="form-label" for="user_photo_url">Your Photo *</label>
                        <input class="form-input" type="file" placeholder="Enter shop photo" name="user_photo_url"
                            id="user_photo_url"
                            value="<?php echo $shop && $shop['user_photo_url'] ? $shop['user_photo_url'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="fname">First Name *</label>
                        <input class="form-input" type="text" placeholder="Eg: Aashish" name="fname" id="fname"
                            value="<?php echo $userID && $record['fname'] ? $record['fname'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="lname">Last Name *</label>
                        <input class="form-input" type="text" placeholder="Eg: Maharjan" name="lname" id="lname"
                            value="<?php echo $userID && $record['lname'] ? $record['lname'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="gender">Gender</label>
                        <div class="form__radio-group">
                            <input type="radio" name="gender" value="M" <?php echo $userID && $record["gender"] == "M" ? "checked" : ""; ?> id="gMale">
                            <label class="form__radio-label" for="gMale">Male</label>

                            <input type="radio" name="gender" value="F" <?php echo $userID && $record["gender"] == "F" ? "checked" : "" ?> id="gFemale">
                            <label class="form__radio-label" for="gFemale">Female</label>

                            <input type="radio" name="gender" value="O" <?php echo $userID && $record["gender"] == "O" ? "checked" : "" ?> id="gOthers">
                            <label class="form__radio-label" for="gOthers">Others</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="dob">Date of Birth (DOB) *</label>
                        <input class="form-input" type="date" placeholder="Eg: MK Company Ltd." name="dob" id="dob"
                            value="<?php echo $userID && $record['dob'] ? $record['dob'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="contact_no">Phone No. *</label>
                        <input class="form-input" type="text" placeholder="Eg: MK Company Ltd." name="contact_no"
                            id="contact_no"
                            value="<?php echo $userID && $record['contact_no'] ? $record['contact_no'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email *</label>
                        <input class="form-input" type="text" placeholder="Eg: aashish.maharjan021@apexcollege.edu.np"
                            name="email" id="email"
                            value="<?php echo $userID && $record['email'] ? $record['email'] : ''; ?>">
                        <span class="text-error"></span>
                    </div>
                </fieldset>


                <button type="submit" name="submit">
                    Update Information
                </button>
            </form>
        </div>

        <br />

        <!-- Includes footer partial from ./includes/_footer.php -->
        <?php include_once("includes/_footer.php"); ?>

    </div>
</body>

</html>