<!DOCTYPE html>
<html>
    <head>
        <title>Photos</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/Photos.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Pagination.css">
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
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/search.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/UserNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">Search</h1>
                <div class="searchfilter">
                    <button id="sortName" class="button-black">A-Z</button>
                    <select id="filter" class="dropdown">
                        <option value="all">All Photos</option>
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                    <img id="button-search" src="<?= BASE_URL ?>/assets/icons/search.png"/>
                    <input type="text" id="fname" class="textfield3" placeholder="Type Username, ID, Name">  
                </div>
            </div>
            <br>
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