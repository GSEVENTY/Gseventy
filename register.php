<?php
ob_start();
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");
require_once("includes/config.php");

$account = new Account($connection);

if (isset($_POST['register_btn'])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST['firstName']);
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);
    $user_role = "user";

    $success = $account->register($firstName, $username, $email, $password, $user_role);

    if ($success) {

        header("Location: login.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="assets/css/style-login-signup.css" />
    <title>Register</title>
</head>

<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <a href="./index.php">
                    <img src="./assets/images/logo_head.png" title="logo" alt="site logo" />
                </a>
                <h3>Register</h3>
                <span>to continue to Website</span>
            </div>

            <form action="" method="POST">

                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="firstName" placeholder="First name" required />

                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="User name" required />

                <?php echo $account->getError(Constants::$emailTaken); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <input type="email" name="email" placeholder="Email" required />

                <?php echo $account->getError(Constants::$passwordLength); ?>
                <input type="password" name="password" placeholder="Password" required />

                <input type="submit" name="register_btn" value="Register" />
            </form>

            <a href="./login.php" class="signInMessage">Already have and account? Sign in here!</a>
        </div>
    </div>
</body>

</html>