<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/User.css">
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
            const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/login.js" defer></script>

    </head>
    <body>
        <div class="content">
            <div class="left">
                <img src="<?= BASE_URL ?>/assets/images/login-page.png" alt="Login Page">   
            </div>
            <div class="right">
                <div class="right-content">
                    <h1 class="title">Login</h1>
                    <div class="card">
                        <h2>Input Your Credentials</h2>
                        <form class="login-form">
                            <div class="form-group">
                                <input type="text" id="username" name="username" class="textfield" placeholder="Username">
                                <p id="username-alert" class="alert-hide"></p>
                            </div>  
                            <div class="form-group">
                                <input type="password" id="password" name="password" class="textfield" placeholder="Password" autocomplete="on">
                                <p id="password-alert" class="alert-hide"></p>
                            </div>
                            <div class="form-button">
                                <p id="login-alert" class="alert-hide">Wrong username/password!</p>
                                <button type="submit" class="button-black">LOGIN</button>
                            </div>
                        </form>

                        <p>Do not have an account? <span><a href="/public/user/register" class="link">REGISTER</a></span></p>
                    </div>
                </div>   
            </div>
        </div>
    </body>
</html>