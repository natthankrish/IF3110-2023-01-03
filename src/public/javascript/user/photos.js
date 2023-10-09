const submit_btn = document.getElementById('submit-photo');
const input = document.getElementById('file-input');
const display_img = document.getElementById('add-photo-display');
const container = document.getElementById('container');
const listPagination = document.getElementById('list-pagination')
const statePage = document.getElementById('state-page')
const leftButton = document.getElementById('left-page-button')
const rightButton = document.getElementById('right-page-button')

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
    let url_photo = object.parentElement.parentElement.parentElement.parentElement.children[0].children[0].id.slice(3);
    let url_video = object.parentElement.parentElement.parentElement.parentElement.children[1].children[0].children[0].id.slice(6);

    const formData = new FormData();
    console.log(url_photo, url_video)
    formData.append("object_id", object_id);
    formData.append("url_video", url_video);
    formData.append("url_photo", url_photo);
    formData.append("csrf_token", CSRF_TOKEN);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/public/object/delete");

    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            object.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
            refresh(12,1);
            setupLength(1)
        }
    };
}

function refresh(perpage, page) {
    container.innerHTML = ''
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/public/object/getByIdUser?perpage=${perpage}&page=${page}`);

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
        console.log(file.type)

        if (file.type == 'video/mp4') {
            console.log('hello');
            // formData.append('image', BASE_URL + "/assets/icons/edit.png");
            formData.append('video', file);
            formData.append("csrf_token", CSRF_TOKEN);
    
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/public/object/storeVideo");
    
            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE) {
                    submit_btn.parentElement.parentElement.parentElement.style.display = "none";
                    refresh(12,1);
                    setupLength(1)
                }
            };
        } else {
            formData.append('image', file);
            formData.append("csrf_token", CSRF_TOKEN);
    
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/public/object/storeImage");
    
            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE) {
                    submit_btn.parentElement.parentElement.parentElement.style.display = "none";
                    refresh(12,1);
                    setupLength(1)
                }
            };
        }
    }
);

function openChangeName(object) {
    object.parentElement.children[2].style.display = "flex";
}

function closeChangeName(object) {
    object.parentElement.parentElement.parentElement.parentElement.style.display = "none";
}

function changeName(object) {
    let object_id = object.parentElement.parentElement.parentElement
                        .parentElement.parentElement.parentElement.parentElement
                        .parentElement.parentElement.parentElement.id

    let textfield = document.getElementById('name' + object_id);
    let text = textfield.value;

    const formData = new FormData();
    formData.append("object_id", object_id);
    formData.append("text", text);
    formData.append("csrf_token", CSRF_TOKEN);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/public/object/updateName");

    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            closeChangeName(object)
            let name = document.getElementById('title' + object_id);
            name.innerText = text;
        }
    };
}

function makePhoto(element) {
    const photoCard = document.createElement('div');
    photoCard.className = 'photo-card';
    photoCard.id = element['object_id'];

    const photoCardHTML = `
        <div class="photo-thumbnail-container">
            <img src="${STORAGE_URL + '/' + (element['type'] == 'Photo' ? 'images' : 'videos') + '/' + element['url_photo']}" class="photo-thumbnail" onclick="openPopUp(this)" id="img${element['url_photo']}"/>
        </div>
        <div class="photo-popup-container">
            <div class="photo-popup">
                <div class="photo-popup-img-container" id="${element['type'] == 'Photo' ? 'images' + element['url_photo'] : 'videos' + element['url_video']}">
                    ${element['type'] === 'Photo'
                        ? `<img src="${STORAGE_URL + '/' + (element['type'] == 'Photo' ? 'images' : 'videos') + '/' + element['url_photo']}" class="photo-popup-img" alt="Photo">`
                        : `<video controls="controls" class="photo-popup-img">
                                <source src="${STORAGE_URL + '/' + (element['type'] == 'Photo' ? 'images' : 'videos') + '/' + element['url_video']}#t=0.1" type="video/mp4">
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
                            <h1 class="photo-popup-name" id="title${element['object_id']}">${element['title']}</h1>
                            <img src="${BASE_URL}/assets/icons/edit.png" class="photo-popup-name-edit" onclick="openChangeName(this)"/>
                            <div class="popup-container">
                                <div class="popup">
                                    <div class="popup-info-container">
                                        <div class="photo-popup-close">
                                            <img src="${BASE_URL}/assets/icons/close.png" class="photo-popup-close" onclick="closeChangeName(this)" />
                                        </div>
                                        <div class="registration-form">
                                            <div class="form-group">
                                                <input type="text" id="name${element['object_id']}" class="textfield" placeholder="New Name">
                                            </div>
                                            <button class="button-black" onclick="changeName(this)">Change Name</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    <button class="button-white" onclick="deletePhoto(this)">Delete This Photo</button>
                </div>
            </div>
        </div>
    `;

    photoCard.innerHTML = photoCardHTML;

    return photoCard;
}

function setupLength(current){
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/public/object/getLengthByIdUser");

    xhr.send();
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            var responseObj = JSON.parse(this.responseText);
            var len = responseObj.object.len;
            statePage.value = current
            displayPagination(len, current)
        }
    };
}

function displayPagination(len, current){
    listPagination.innerHTML = '';
    if(current == 1){
        leftButton.style.display = "none"
    }else{
        leftButton.style.display = "block"
    }
    if(current == Math.ceil(len/12)){
        rightButton.style.display = "none"
    }else{
        rightButton.style.display = "block"
    }
    for(let i=0;i<=len;i+=12){
        if(i>current-3 || i<current+3){
            const p = document.createElement('p')
            p.innerHTML = (i+12)/12
            p.className = 'page-item'
            if((i+12)/12 == current){
                p.style.fontSize = '38px'
                p.style.fontWeight = 'bold'
            }
            p.onclick = () => {
                refresh(12, (i+12)/12)
                statePage.value =(i+12)/12
                displayPagination(len,(i+12)/12)
            }
            listPagination.appendChild(p)
        }
    }
}

// leftButton.addEventListener('click', () => {
//     refresh(12, statePage.value-1)
//     setupLength(12, statePage.value-1)
// })

// rightButton.addEventListener('click', () => {
//     refresh(12, statePage.value+1)
//     setupLength(12, statePage.value+1)
// })


window.addEventListener(
    "load",
    debounce(() => {
        refresh(12,1)
        setupLength(1)
    }, DEBOUNCE_TIMEOUT)
);
