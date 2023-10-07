const container = document.getElementById('container');

function openPopUp(object) {
    object.parentElement.parentElement.children[1].style.display = "flex";
}

function closePopUp(object) {
    object.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
}

function changeLike(object) {
    let object_id = object.parentElement.parentElement.parentElement.parentElement
                        .parentElement.parentElement.id;

    if (object.src == BASE_URL + "/assets/icons/heart.png") {
        const formData = new FormData();
        formData.append("object_id", object_id);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/public/like/store");

        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                object.src = BASE_URL + "/assets/icons/liked.png";
            }
        };
    } else {
        const formData = new FormData();
        formData.append("object_id", object_id);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/public/like/delete");

        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                object.src = BASE_URL + "/assets/icons/heart.png";
            }
        };
    }          
}

function isLiked(element) {
    let object_id = element['object_id'];
    let object = document.getElementById('likestat' + element['object_id']);

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/public/like/isLiked?object_id=" + object_id);

    xhr.send();
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            var responseObj = JSON.parse(this.responseText);
            console.log(responseObj);
            if (responseObj['like']) {
                object.src = BASE_URL + "/assets/icons/liked.png";
            } else {
                object.src = BASE_URL + "/assets/icons/heart.png";
            }
        }
    };                    
}

function getUsername(element) {
    let object = document.getElementById('uname' + element['object_id']);

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/public/user/getUsername?user_id=" + element['user_id']);

    xhr.send();
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            var responseObj = JSON.parse(this.responseText);
            console.log(this.responseText);
            object.innerText = responseObj["username"]["username"];
        }
    };                    
}

function makeUserComment() {
    const commentItemDiv = document.createElement("div");
    commentItemDiv.classList.add("comment-item");

    const commentContainerDiv = document.createElement("div");
    commentContainerDiv.classList.add("comment-container");

    const commentSenderP = document.createElement("p");
    commentSenderP.classList.add("comment-sender");
    commentSenderP.textContent = "natthankrish";

    const commentContentP = document.createElement("p");
    commentContentP.classList.add("comment-content");
    commentContentP.textContent = "BAGUS BANGET ASTAGA";

    commentContainerDiv.appendChild(commentSenderP);
    commentContainerDiv.appendChild(commentContentP);

    commentItemDiv.appendChild(commentContainerDiv);
}

function makeAdminComment() {
    const commentItemDiv = document.createElement("div");
    commentItemDiv.classList.add("comment-item");

    const commentContainerDiv = document.createElement("div");
    commentContainerDiv.classList.add("comment-container");

    const commentSenderP = document.createElement("p");
    commentSenderP.classList.add("comment-sender");
    commentSenderP.textContent = "natthankrish";

    const commentContentP = document.createElement("p");
    commentContentP.classList.add("comment-content");
    commentContentP.textContent = "BAGUS BANGET ASTAGA";

    const trashIconImg = document.createElement("img");
    trashIconImg.src = BASE_URL + "/assets/icons/trash.png";
    trashIconImg.classList.add("photo-popup-property-icon");

    commentContainerDiv.appendChild(commentSenderP);
    commentContainerDiv.appendChild(commentContentP);

    commentItemDiv.appendChild(commentContainerDiv);
    commentItemDiv.appendChild(trashIconImg);
}

function makeComment(element) {

}

function addComment(element) {

}

function makeFeed(element) {
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
                        <img src="${BASE_URL}/assets/icons/close.png" onclick="closePopUp(this)" />
                    </div>
                    <br>
                    <div class="scrollable">
                        <div class="photo-popup-name-container">
                            <h2 class="photo-popup-name">${element['description'] == 'null' ? "No Description" : element['description']}</h2>
                        </div>
                        <br>
                        <div class="photo-popup-info-property">
                            <img src="${BASE_URL}/assets/icons/profile.png" class="photo-popup-property-icon"/>
                            <p class="photo-popup-property-desc" id="uname${element['object_id']}"></p>
                        </div>
                        <div class="photo-popup-info-property">
                            <img src="${BASE_URL}/assets/icons/heart.png" class="photo-popup-property-icon" onclick="changeLike(this)" id="likestat${element['object_id']}"/>
                            <p class="photo-popup-property-desc">Like</p>
                        </div>
                        <div class="photo-popup-info-property">
                            <img src="${BASE_URL}/assets/icons/date.png" class="photo-popup-property-icon"/>
                            <p class="photo-popup-property-desc">${element['post_date']}</p>
                        </div>
                        <br>
                        <h1 class="visibility-status">Comments</h1>
                        <div class="comments-container" id="comments${element['object_id']}">
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
    `;

    photoCard.innerHTML = photoCardHTML;

    return photoCard;
}

function refresh() {
    container.innerHTML = '';
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/public/object/getPublic");

    xhr.send();
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            var responseObj = JSON.parse(this.responseText);
            var objectArray = responseObj.object;
            objectArray.forEach(element => {
                container.appendChild(
                    makeFeed(element)
                )
                isLiked(element);
                getUsername(element)
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
                refresh()
            }
        };
    }, DEBOUNCE_TIMEOUT)
);