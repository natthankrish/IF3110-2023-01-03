<!DOCTYPE html>
<html>
    <head>
        <title>Photos</title>
        <link rel="icon" href="<?= BASE_URL ?>/assets/icons/logo.png">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/Photos.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Navbar.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/object/Pagination.css">
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
                            <img src="<?= BASE_URL ?>/assets/icons/photo-th.png" class="add-photo-img">
                            <button class="button-white">Choose File</button>
                            <div class="form-group">
                                <input type="password" id="photo-name" name="password" class="textfield" placeholder="Photo Name" autocomplete="on">
                            </div>
                            <div class="form-group">
                                <input type="password" id="photo-name" name="password" class="textfield" placeholder="Photo Location" autocomplete="on">
                            </div>
                            <button class="button-black" onclick="addPhoto(this)">Upload Photo</button>
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
        <script>
            function openPopUp(object) {
                object.parentElement.parentElement.children[1].style.display = "flex";
            }

            function closePopUp(object) {
                object.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
            }

            function openAddPhoto(object) {
                object.parentElement.children[2].style.display = "flex";
            }

            function closeAddPhoto(object) {
                object.parentElement.parentElement.parentElement.parentElement.parentElement.children[2].style.display = "none";
            }

            function changeStatus(object) {
                let stat = object.parentElement.children[7];
                if (object.innerText == "Show in My Profile") {
                    object.innerText = "Hide from My Profile";
                    stat.innerText = "Others can see this picture"
                } else {
                    object.innerText = "Show in My Profile";
                    stat.innerText = "Others can't see this picture"
                }
            }
        </script>
    </body>
</html>