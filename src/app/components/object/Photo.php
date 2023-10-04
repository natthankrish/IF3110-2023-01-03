<div class="photo-card">
    <div class="photo-thumbnail-container">
        <img src="<?= BASE_URL ?>/assets/icons/photo-th.png" class="photo-thumbnail" onclick="openPopUp(this)"/>
    </div>
    <div class="photo-popup-container">
        <div class="photo-popup">
            <div class="photo-popup-img-container">
                <video controls="controls" class="photo-popup-img">
                    <source src="<?= BASE_URL ?>/assets/images/video-test.mp4#t=0.1" type="video/mp4">
                </video>
            </div>
            <div class="photo-popup-info-container">
                <div class="photo-popup-info">
                    <div class="photo-popup-close">
                        <img src="<?= BASE_URL ?>/assets/icons/close.png" onclick="closePopUp(this)" />
                    </div>
                    <br>
                    <div class="photo-popup-name-container">
                        <h1 class="photo-popup-name">NAMa</h1>
                        <img src="<?= BASE_URL ?>/assets/icons/edit.png" class="photo-popup-name-edit"/>
                    </div>
                    <br>
                    <div class="photo-popup-info-property">
                        <img src="<?= BASE_URL ?>/assets/icons/location.png" class="photo-popup-property-icon"/>
                        <p class="photo-popup-property-desc">Location</p>
                    </div>
                    <div class="photo-popup-info-property">
                        <img src="<?= BASE_URL ?>/assets/icons/date.png" class="photo-popup-property-icon"/>
                        <p class="photo-popup-property-desc">Date</p>
                    </div>
                    <br>
                    <h1 class="visibility-status">Others can't see this photos</h1>
                    <button class="button-black" onclick="changeStatus(this)">Show in My Profile</button>
                </div>
                <button class="button-white">Delete This Photo</button>
            </div>
        </div>
    </div>
</div>