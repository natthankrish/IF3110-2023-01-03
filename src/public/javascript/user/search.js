const container = document.getElementById('photo-container')
const listPagination = document.getElementById('list-pagination')
const buttonSearch = document.getElementById('button-search')
const textbox = document.getElementById('fname')

function openPopUp(object) {
    object.parentElement.parentElement.children[1].style.display = "flex";
}

function closePopUp(object) {
    object.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
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
                    <button class="button-white" onclick="deletePhoto(this)" id=${element['url_photo']}>Delete This Photo</button>
                </div>
            </div>
        </div>
    `;

    photoCard.innerHTML = photoCardHTML;

    return photoCard;
}

function refresh(perpage, page, filter) {
    container.innerHTML = '';
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/public/object/getPublicById?perpage=${perpage}&page=${page}&filter=${filter}`);

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

function setupLength(filter){
    listPagination.innerHTML = '';
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/public/object/getLengthPublicById?filter=${filter}`);

    xhr.send();
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            var responseObj = JSON.parse(this.responseText);
            var len = responseObj.object.len;
            for(let i=0;i<=len;i+=12){
                const p = document.createElement('p')
                p.innerHTML = (i+12)/12
                p.className = 'page-item'
                p.onclick = () => refresh(12, (i+12)/12)
                listPagination.appendChild(p)
            }
        }
    };
}

buttonSearch.addEventListener('click', () => {
    refresh(12, 1, textbox.value)
    setupLength(textbox.value)
})

window.addEventListener(
    "load",
    debounce(() => {
        refresh(12, 1, "")
        setupLength("")
    }, DEBOUNCE_TIMEOUT)
);
