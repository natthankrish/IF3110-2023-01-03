<!DOCTYPE html>
<html>
    <head>
        <title>Manage My Account</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/ManageMyAccountAdminStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
            const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/admin/manage.js" defer></script>

    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/AdminNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <div class="left">
                    <div class="left1">
                        <h1 class="title">Manage Account</h1>
                        <h2>Admin #ID</h2>
                    </div>
                </div>
                <button class="button-white" id="log-out">Logout</button>
            </div>
            <br>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Username</h2>
                    <h3>Current Username: natthankrish</h3>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname" name="fname" class="textfield" placeholder="Username"><br>    
                    <input type="submit" value="Confirm" class="button">
                </form>
            </div>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Name</h2>
                    <h3>Current Name: Natthan</h3>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname2" name="fname" class="textfield" placeholder="Name"><br>    
                    <input type="submit" value="Confirm" class="button">
                </form>
            </div>

            <div class="item-settings-container">
                <div class="item-settings-label">
                    <h2>Password</h2>
                </div>
                <form action="/action_page.php" class="form">
                    <input type="text" id="fname3" name="fname" class="textfield" placeholder="New Password"><br>  
                    <input type="text" id="fname4" name="fname" class="textfield" placeholder="Confirm Password"><br>    
                    <input type="submit" value="Confirm" class="button">
                </form>
            </div>

        </div>
    </body>
</html>