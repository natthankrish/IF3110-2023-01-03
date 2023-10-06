submit_btn = document.getElementById('submit-photo');
input = document.getElementById('file-input');
display_img = document.getElementById('add-photo-display');
container = document.getElementById('container');

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
    let isPublic = undefined;
    if (object.innerText == "Show in My Profile") {
        isPublic = 0;
    } else {
        isPublic = 1;
    }

    let object_id = object.parentElement.parentElement.parentElement.parentElement.parentElement.id;

    console.log(object_id, isPublic)
    const formData = new FormData();
    formData.append("object_id", object_id);
    formData.append("isPublic", isPublic);
    formData.append("csrf_token", CSRF_TOKEN);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/public/object/updateIsPublic");

    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            let stat = object.parentElement.children[7];
            console.log("done");
            if (object.innerText == "Show in My Profile") {
                object.innerText = "Hide from My Profile";
                stat.innerText = "Others can see this photo";
            } else {
                object.innerText = "Show in My Profile";
                stat.innerText = "Others can't see this photo";
            }
        }
    };
}

function deletePhoto(object) {
    let object_id = object.parentElement.parentElement.parentElement.parentElement.id;
    let object_name = object.id

    const formData = new FormData();
    formData.append("object_id", object_id);
    formData.append("object_name", object_name);
    formData.append("csrf_token", CSRF_TOKEN);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/public/object/delete");

    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            object.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
            refresh();
        }
    };
}

function refresh() {
    container.innerHTML = '';
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/public/object/getByIdUser");

    xhr.send();
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            var responseObj = JSON.parse(this.responseText);
            var objectArray = responseObj.object;
            objectArray.forEach(element => {
                container.appendChild(
                    makePhoto(element)
                )
            });
            console.log(this.responseText);
        }
    };
}


input.addEventListener('change', function(e) {
    var file = e.target.files[0]; 
    var objectURL = URL.createObjectURL(file);
    display_img.src = objectURL;
})

submit_btn.addEventListener(
    "click",
    function () {
        file = input.files[0];

        const formData = new FormData();
        formData.append("title", file.name);
        formData.append("date", '12/12/2012');
        formData.append("location", "HEHE");
        formData.append('image', file);
        formData.append("csrf_token", CSRF_TOKEN);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/public/object/storeImage");

        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                submit_btn.parentElement.parentElement.parentElement.style.display = "none";
                refresh();
            }
        };
    }
);

function makePhoto(element) {
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
                    ${element['type'] === 'Photo'
                        ? `<img src="${STORAGE_URL + '/' + (element['type'] == 'Photo' ? 'images' : 'videos') + '/' + element['url_photo']}" class="photo-popup-img" alt="Photo">`
                        : `<video controls="controls" class="photo-popup-img">
                                <source src="${STORAGE_URL + '/' + (element['type'] == 'Photo' ? 'images' : 'videos') + '/' + element['url_photo']}#t=0.1" type="video/mp4">
                           </video>`
                    }
                </div>
                <div class="photo-popup-info-container">
                    <div class="photo-popup-info">
                        <div class="photo-popup-close">
                            <img src="${BASE_URL}/assets/icons/close.png" onclick="closePopUp(this)" />
                        </div>
                        <br>
                        <div class="photo-popup-name-container">
                            <h1 class="photo-popup-name">${element['title']}</h1>
                            <img src="${BASE_URL}/assets/icons/edit.png" class="photo-popup-name-edit"/>
                        </div>
                        <br>
                        <div class="photo-popup-info-property">
                            <img src="${BASE_URL}/assets/icons/location.png" class="photo-popup-property-icon"/>
                            <p class="photo-popup-property-desc">${element['location']}</p>
                        </div>
                        <div class="photo-popup-info-property">
                            <img src="${BASE_URL}/assets/icons/date.png" class="photo-popup-property-icon"/>
                            <p class="photo-popup-property-desc">${element['date']}</p>
                        </div>
                        <br>
                        <h1 class="visibility-status">${element['isPublic'] == 0 ? "Others can't see this photo" : "Others can see this photo"}</h1>
                        <button class="button-black" onclick="changeStatus(this)">${element['isPublic'] == 0 ? "Show in My Profile" : "Hide From My Profile"}</button>
                    </div>
                    <button class="button-white" onclick="deletePhoto(this)" id=${element['url_photo']}>Delete This Photo</button>
                </div>
            </div>
        </div>
    `;

    photoCard.innerHTML = photoCardHTML;

    return photoCard;
}

window.addEventListener(
    "load",
    debounce(() => {
        refresh()
    }, DEBOUNCE_TIMEOUT)
);
