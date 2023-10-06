<!DOCTYPE html>
<html>
    <head>
        <title>Feeds</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/Photos.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Pagination.css">

        <!-- JavaScript Constant and Variables -->
        <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
            const DEBOUNCE_TIMEOUT = "<?= DEBOUNCE_TIMEOUT ?>";
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/feeds.js" defer></script>
        <!-- <script type="text/javascript" src="<?= BASE_URL ?>/javascript/component/Photo.js" defer></script> -->
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/UserNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">Feeds</h1>
                <form action="/action_page.php" class="form">
                    <img src="<?= BASE_URL ?>/assets/icons/search.png"/>
                    <input type="text" id="fname" name="fname" class="textfield" placeholder="Type Username / Desc"><br>    
                </form>
            </div>
            <br>
            <div class="photo-container" id="container">
            </div>
            <?php include(dirname(__DIR__) . '/object/Pagination.php') ?>
        </div>
    </body>
</html>