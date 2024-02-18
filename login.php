<?php require_once("./config/db.config.php"); ?>
<?php require_once("./model/UserManager.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/epasale/public/css/style.css">
    <link rel="stylesheet" href="/epasale/public/css/login.css" />
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userManager = new UserManager($conn);
    $userManager->login($_POST);
}
?>

<body>

    <div class="form__container">
        <div class="form">
            <h1 class="form__h1">SIGN IN</h1>
            <form class="form__wrapper" onsubmit="return LoginValidateForm()" method="POST">
                <div class="form-group">
                    <label class="form-label" for="email"><i class="fa fa-user"></i> Email</label>
                    <input class="form-input" type="email" id="email" name="email" placeholder="Enter your email">
                    <span class="error-msg"></span>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password"><i class="fa fa-lock"></i> Password</label>
                    <input class="form-input" type="password" id="password" name="password"
                        placeholder="Enter your password">
                    <span class="error-msg"></span>
                </div>

                <div class="form-group">
                    <button type="submit" class="button btn-primary" style="width: 100%;">
                        Sign in <i class="fa fa-arrow-right-to-bracket"></i>
                    </button>
                </div>


                <!-- <a class="link form__link" href="/epasale">Forgot your Password?</a> <br /> -->
                <div class="form-group form__form-links">
                    New to ePasal?
                    <a class="link form__link" href="/epasale/signup.php"> Create your ePasal Account</a>
                </div>
            </form>
        </div>
    </div>
    <script src="/epasale/public/js/validator.js"></script>
    <script>
        // function to validate the login form
        function LoginValidateForm() {
            // Get form input elements
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            const image = document.getElementById('image');



        // Clear previous error messages
        Validator.clearInputErrors();


        // Validate email and password input
        const isEmailValid = Validator.validateRequired(email, "Please enter valid email.");
        const isPasswordStrong=Validator.validatePassword(password,"Your Password is Weak");
        const isPasswordValid = Validator.validateRequired(password, "Please enter valid Password.");


        // If all validations pass, show success alert
        if(isEmailValid && isPasswordStrong && isPasswordValid) {
            alert("Your form looks good");
            alert("You can now submit your form");
            document.getElementById('loginForm').submit();
        }
        // if fail, Prevent default form submission
        return false;

    }

            // Clear previous error messages
            Validator.clearInputErrors();

            // Validate email and password input
            const isEmailValid = Validator.validateRequired(email, "Please enter valid email.");
            const isPasswordValid = Validator.validateRequired(password, "Please enter valid Password.");


            // If all validations pass, show success alert
            if (isEmailValid && isPasswordValid) {
                return true;
            }
            // if fail, Prevent default form submission
            return false;
        }
    </script>
</body>

</html>