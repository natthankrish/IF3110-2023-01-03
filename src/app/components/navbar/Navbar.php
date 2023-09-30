<?php
 
function createHeader() {
  return '
    <div class="navbar-container">
        <div class="navbar">
            <a class="navbar-item">
                <img src="./assets/icons/photos.png" alt="My Photos">
                <p class="navbar-item-desc">My Photos</p>
            </a>
            <a class="navbar-item">
                <img src="./assets/icons/search.png" alt="Search">
                <p class="navbar-item-desc">Search</p>
            </a>
            <a class="navbar-item">
                <img src="./assets/icons/feeds.png" alt="Feeds">
                <p class="navbar-item-desc">Feeds</p>
            </a>
            <a class="navbar-item">
                <img src="./assets/icons/profile.png" alt="Profile">
                <p class="navbar-item-desc">Profile</p>
            </a>
        </div>
	</div>';
}