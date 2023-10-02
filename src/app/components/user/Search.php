<!DOCTYPE html>
<html>
    <head>
        <title>Photos</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/PhotosStyles.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Pagination.css">
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/UserNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <h1 class="title">Search</h1>
                <form action="/action_page.php" class="form">
                    <img src="<?= BASE_URL ?>/assets/icons/search.png"/>
                    <input type="text" id="fname" name="fname" class="textfield" placeholder="Type Username, ID, Name"><br>    
                </form>
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
        <script>
            function openPopUp(object) {
                object.parentElement.parentElement.children[1].style.display = "flex";
            }

            function closePopUp(object) {
                object.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
            }
        </script>
    </body>
</html>