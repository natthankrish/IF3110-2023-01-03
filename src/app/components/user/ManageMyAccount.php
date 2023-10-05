<!DOCTYPE html>
<html>
    <head>
        <title>Manage My Account</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/ManageMyAccountStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
            const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/manage.js" defer></script>

    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/UserNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">Manage My Account</h1>
                <a href="/public/user/profile">
                    <button class="button-black">Back</button>
                </a>
            </div>
            <br>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Username</h2>
                    <h3 id="current-username"></h3>
                </div>
                <form class="form" id="username-form">
                    <input type="text" id="username" name="username" class="textfield" placeholder="Username"><br>
                    <p id="username-alert" class="alert-hide"></p>
                    <input type="submit" value="Confirm" class="button-black" id="username-confirm">
                </form>
            </div>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Name</h2>
                    <h3 id="current-fullname"></h3>
                </div>
                <form class="form" id="fullname-form">
                    <input type="text" id="fullname" name="fullname" class="textfield" placeholder="Name"><br>   
                    <p id="fullname-alert" class="alert-hide"></p> 
                    <input type="submit" value="Confirm" class="button-black" id="fullname-confirm">
                </form>
            </div>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Password</h2>
                </div>
                <form class="form" id="password-form">
                    <input type="password" id="password" name="password" class="textfield" placeholder="New Password"><br>
                    <input type="password" id="confirm-password" name="confirm-password" class="textfield" placeholder="Confirm Password"><br>
                    <p id="password-alert" class="alert-hide"></p>
                    <input type="submit" value="Confirm" class="button-black" id="password-confirm">
                </form>
            </div>

            <h2>Storage Usage</h2>
            <p class="usage" id="usage"></p>
        </div>
    </body>
</html>