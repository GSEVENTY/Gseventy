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
        $db_username = $user->username;
        $logged = true;


        $_SESSION['username'] = $db_username;
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
    <div class="page">
        <div class="container">
            <div class="left">
                <div class="login">Login</div>
                <div class="eula">By logging in you agree to the ridiculously long terms that you didn't bother to read</div>
            </div>
            <div class="right">
                <svg viewBox="0 0 320 300">
                    <defs>
                        <linearGradient inkscape:collect="always" id="linearGradient" x1="13" y1="193.49992" x2="307" y2="193.49992" gradientUnits="userSpaceOnUse">
                            <stop style="stop-color:#60afeb;" offset="0" id="stop876" />
                            <stop style="stop-color:#f224d0;" offset="1" id="stop878" />
                        </linearGradient>
                    </defs>
                    <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                </svg>
                <div class="form">
                    <form action="" method="POST">
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required />
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required />
                        <input type="submit" id="submit" name="login" value="Login" />
                        <!-- <p> Error!! </p> -->
                        <div class="link">
                            <a href="register.php">Need an account? Register Here</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="assets/js/app_login_register.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script>
</body>

</html>