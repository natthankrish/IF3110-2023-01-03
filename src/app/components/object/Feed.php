<div class="photo-card">
    <img src="<?= BASE_URL ?>/assets/icons/photo-th.png" class="photo-thumbnail" onclick="openPopUp(this)"/>
    <div class="photo-popup-container">
        <div class="photo-popup">
            <div class="photo-popup-img-container">
                <img src="<?= BASE_URL ?>/assets/icons/photo-th.png" class="photo-popup-img"/>
            </div>
            <div class="photo-popup-info-container">
                <div class="photo-popup-close">
                    <img src="<?= BASE_URL ?>/assets/icons/close.png" onclick="closePopUp(this)" />
                </div>
                <br>
                <div class="scrollable">
                    <div class="photo-popup-name-container">
                        <h2 class="photo-popup-name">Desc</h2>
                    </div>
                    <br>
                    <div class="photo-popup-info-property">
                        <img src="<?= BASE_URL ?>/assets/icons/profile.png" class="photo-popup-property-icon"/>
                        <p class="photo-popup-property-desc">User</p>
                    </div>
                    <div class="photo-popup-info-property">
                        <img src="<?= BASE_URL ?>/assets/icons/heart.png" class="photo-popup-property-icon"/>
                        <p class="photo-popup-property-desc">Like</p>
                    </div>
                    <div class="photo-popup-info-property">
                        <img src="<?= BASE_URL ?>/assets/icons/date.png" class="photo-popup-property-icon"/>
                        <p class="photo-popup-property-desc">Posted Date</p>
                    </div>
                    <br>
                    <h1 class="visibility-status">Comments</h1>
                    <div class="comments-container">
                        <?php include(dirname(__DIR__) . '/object/Comment.php') ?>
                        <?php include(dirname(__DIR__) . '/object/Comment.php') ?>
                        <?php include(dirname(__DIR__) . '/object/Comment.php') ?>
                        <?php include(dirname(__DIR__) . '/object/Comment.php') ?>
                        <?php include(dirname(__DIR__) . '/object/Comment.php') ?>
                        <?php include(dirname(__DIR__) . '/object/Comment.php') ?>
                    </div>
                </div>
                <div>
                    <form action="/action_page.php" class="form">
                        <input type="text" id="fname2" name="fname" class="textfield2" placeholder="Write a comment"><br>    
                        <input type="submit" value="Send" class="button-black">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>