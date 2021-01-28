<?php
ob_start();
session_start();
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");
require_once("includes/config.php");

$account = new Account($connection);

if (isset($_POST['login'])) {
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);

    $success = $account->login($username, $password);

    if ($success) {

        $query = $connection->prepare("SELECT * FROM users WHERE username=:un");
        $query->execute(['un' => $username]);
        $user = $query->fetch();

        $db_user_id = $user->user_id;
        $db_user_role = $user->user_role;
        $db_user_firstname = $user->user_firstname;
        $logged = true;

        
        
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['logged_in'] = $logged;
       
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="assets/css/style-login-signup.css" />
    <title>Login In</title>
</head>

<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <a href="./index.php">
                    <img src="./assets/images/logo_head.png" title="logo" alt="site logo" />
                </a>
                <h3>Login</h3>
                <span>to continue to Website</span>
            </div>

            <form action="" method="POST">

                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="username" placeholder="Username" required />

                <input type="password" name="password" placeholder="Password" required />

                <input type="submit" name="login" value="Login" />
            </form>

            <a href="./register.php" class="signInMessage">Need an account? Register here</a>
        </div>
    </div>
</body>

</html>