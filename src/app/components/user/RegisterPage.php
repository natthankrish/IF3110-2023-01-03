<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/profile.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/User.css">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
            const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/register.js" defer></script>

    </head>
    <body>
        <div class="content">
            <div class="left">
                <img src="<?= BASE_URL ?>/assets/images/register-page.png" alt="Register Page">  
            </div>
            <div class="right">
                <div class="right-content">
                    <h1 class="title">Register</h1>
                    <div class="card">
                        <h2>Fill details</h2>
                        <form class="registration-form">
                            <div class="form-group">
                                <input type="text" id="fullname" name="fullname" class="textfield" placeholder="Full Name">
                                <p id="fullname-alert" class="alert-hide"></p>
                            </div>
                            <div class="form-group">
                                <input type="text" id="username" name="username" class="textfield" placeholder="Username">
                                <p id="username-alert" class="alert-hide"></p>
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="textfield" placeholder="Email">
                                <p id="email-alert" class="alert-hide"></p>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" class="textfield" placeholder="Password" autocomplete="on">
                                <p id="password-alert" class="alert-hide"></p>
                            </div>
                            <div class="form-group">
                                <input type="password" id="confirm-password" name="confirm-password" class="textfield" placeholder="Confirm Password" autocomplete="on">
                                <p id="confirm-password-alert" class="alert-hide"></p>
                            </div>
                            
                            <div class="form-button">
                                <button type="submit" class="button-black">REGISTER</button>
                            </div>
                        </form>

                        <p>Have an account? <span><a href="/public/user/login" class="link">LOGIN</a></span></p>
                    </div>
                </div>   
            </div>
        </div>
    </body>
</html>