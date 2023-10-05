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
        </script>

        <!-- JavaScript Library -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/lib/debounce.js" defer></script>

        <!-- JavaScript DOM and AJAX -->
        <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/photos.js" defer></script>
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/UserNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">My Photos</h1>
                <button class="button-white" onclick="openAddPhoto(this)">Add Photos</button>
                <div class="photo-popup-container">
                    <div class="add-photo-popup">
                        <div class="add-photo-popup-info-container">
                            <div class="photo-popup-close">
                                <img src="<?= BASE_URL ?>/assets/icons/close.png" class="photo-popup-close" onclick="closeAddPhoto(this)" />
                            </div>
                            <img src="<?= BASE_URL ?>/assets/icons/photo-th.png" class="add-photo-img" id="add-photo-display">
                            <label for="file-input" class="button-white">Choose File</label>
                            <input type="file" id="file-input" name="password" placeholder="Photo Input">
                            <div class="form-group">
                                <input type="text" id="photo-loc" name="password" class="textfield" placeholder="Photo Location" autocomplete="on">
                            </div>
                            <button class="button-black" id="submit-photo">Upload Photo</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="photo-container">
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
                <?php include(dirname(__DIR__) . '/object/Photo.php') ?>
            </div>
            <?php include(dirname(__DIR__) . '/object/Pagination.php') ?>
        </div>
    </body>
</html>