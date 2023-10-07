<!DOCTYPE html>
<html>
    <head>
        <title>User Detail</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/UserDetailStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
            const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
            const USERNAME = "<?= $this->data['username'] ?? '' ?>";
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/admin/user-detail.js" defer></script>

    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/AdminNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <div class="left">
                    <div class="left1">
                        <h1 class="title">Manage Account</h1>
                        <h2 id=current-user></h2>
                    </div>
                    <button class="button2" id="delete-button">Delete Account</button>
                </div>
                <a href="/public/admin/users">
                    <button class="button">Back</button>
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
                    <input type="submit" value="Confirm" class="button" id="username-confirm">
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
                    <input type="submit" value="Confirm" class="button" id="fullname-confirm">
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
                    <input type="submit" value="Confirm" class="button" id="password-confirm">
                </form>
            </div>

            <div class="item-setting-container1">
                <div class="item-setting-label"> 
                    <h2>Storage Usage</h2>
                    <p class="usage" id="usage"></p>
                </div>
                <form class="form1" id="storage-form">
                    <input type="text" id="storage" name="storage" class="textfield1" placeholder="100">
                    <h2>GB</h2>
                    <p id="storage-alert" class="alert-hide"></p>
                    <input type="submit" value="Upgrade" class="button3" id="storage-confirm">
                </form>
            </div>
        </div>
    </body>
</html>