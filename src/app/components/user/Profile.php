<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/Photos.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Pagination.css">
    </head>
    <body>
        <?php include(dirname(__DIR__) . '/object/UserNavbar.php') ?>
        <div class="content">
            <div class="item-settings-container">
                <div class="left">
                    <div class="left1">
                        <h1 class="profile-name">Natthan Krish</h1>
                        <h2 class="profile-username">@natthankrish</h3>
                        <a href="/public/user/manage">
                            <button class="button-white">Manage Account</button>
                        </a>
                    </div>
                </div>
                <button class="button-white">Logout</button>
            </div>
            <br>
            <h1 class="title">Recently Posted</h1>
            <div class="photo-container">
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
                <?php include(dirname(__DIR__) . '/object/Post.php') ?>
            </div>
            <?php include(dirname(__DIR__) . '/object/Pagination.php') ?>
        </div>
        <script>
            function openPopUp(object) {
                object.parentElement.parentElement.children[1].style.display = "flex";
            }

            function closePopUp(object) {
                object.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
            }
        </script>
    </body>
</html>