const fullname = document.getElementById("name");
const username = document.getElementById("username");
const logOutButton = document.querySelector("#log-out");
const container = document.getElementById('container');

function openPopUp(object) {
    object.parentElement.parentElement.children[1].style.display = "flex";
}

function closePopUp(object) {
    object.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
}

function makePost(element) {
    const photoCard = document.createElement('div');
    photoCard.className = 'photo-card';
    photoCard.id = element['object_id'];

    const photoCardHTML = `
        <div class="photo-thumbnail-container">
            <img src="${STORAGE_URL + '/' + (element['type'] == 'Photo' ? 'images' : 'videos') + '/' + element['url_photo']}" class="photo-thumbnail" onclick="openPopUp(this)"/>
        </div>
        <div class="photo-popup-container">
            <div class="photo-popup">
                <div class="photo-popup-img-container">
                    <img src="${STORAGE_URL + '/' + (element['type'] == 'Photo' ? 'images' : 'videos') + '/' + element['url_photo']}" class="photo-popup-img"/>
                </div>
                <div class="photo-popup-info-container">
                    <div class="photo-popup-close">
                        <img src="<?= BASE_URL ?>/assets/icons/close.png" onclick="closePopUp(this)" />
                    </div>
                    <br>
                    <div class="scrollable">
                        <div class="photo-popup-name-container">
                            <h2 class="photo-popup-name">${element['description']}</h2>
                        </div>
                        <br>
                        <div class="photo-popup-info-property">
                            <img src="<?= BASE_URL ?>/assets/icons/heart.png" class="photo-popup-property-icon"/>
                            <p class="photo-popup-property-desc">${element['likes']} Likes</p>
                        </div>
                        <div class="photo-popup-info-property">
                            <img src="<?= BASE_URL ?>/assets/icons/date.png" class="photo-popup-property-icon"/>
                            <p class="photo-popup-property-desc">${element['post_date']}</p>
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
                    <button class="button-white" onclick="">Hide this photo from my profile</button>
                </div>
            </div>
        </div>
    `;

    photoCard.innerHTML = photoCardHTML;

    return photoCard;
}

function refresh() {
    console.log('Hello');
    container.innerHTML = '';
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/public/object/getPublicById");

    xhr.send();
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            var responseObj = JSON.parse(this.responseText);
            console.log(this.responseText);
            var objectArray = responseObj.object;
            objectArray.forEach(element => {
                container.appendChild(
                    makePost(element)
                )
            });
            console.log(objectArray);
        }
    };
}


window.addEventListener(
    "load",
    debounce(() => {
        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/user/data?csrf_token=${CSRF_TOKEN}`
        );
        
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const data = JSON.parse(this.responseText);
                fullname.innerText = data['fullname'];
                username.innerText = "@" + data['username'];
                refresh()
            }
        };
    }, DEBOUNCE_TIMEOUT)
);

logOutButton &&
    logOutButton.addEventListener("click", async (e) => {
        e.preventDefault();
        const xhr = new XMLHttpRequest();

        xhr.open("POST", `/public/user/logout`);

        const formData = new FormData();
        formData.append("csrf_token", CSRF_TOKEN);
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                const data = JSON.parse(this.responseText);
                location.replace(data.redirect_url);
            }
        };
    });