<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/Photos.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Pagination.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
            const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
            const BASE_URL = "<?= BASE_URL ?>";
            const STORAGE_URL = "<?= STORAGE_URL ?>";
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/profile.js" defer></script>

    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/UserNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <div class="left">
                    <div class="left1">
                        <h1 class="profile-name" id="name"></h1>
                        <h2 class="profile-username" id="username"></h3>
                        <a href="/public/user/manage">
                            <button class="button-white">Manage Account</button>
                        </a>
                    </div>
                </div>
                <button class="button-white" id="log-out">Logout</button>
            </div>
            <br>
            <h1 class="title">Recently Posted</h1>
            <div class="photo-container" id="container">
            </div>
            <div class="pagination">
                <img src="<?= BASE_URL ?>/assets/icons/left.png" class="page-button" id="left-page-button" alt="Previous"/>
                <div id="list-pagination">
                </div>
                <img src="<?= BASE_URL ?>/assets/icons/right.png" class="page-button" id="right-page-button" alt="Next"/>
                <input id="state-page" value="1"/>
            </div>
        </div>
    </body>
</html>