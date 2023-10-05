submit_btn = document.getElementById('submit-photo');
input = document.getElementById('file-input');
display_img = document.getElementById('add-photo-display')

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

input.addEventListener('change', function(e) {
    var file = e.target.files[0]; 
    var objectURL = URL.createObjectURL(file);
    display_img.src = objectURL;
})

submit_btn.addEventListener(
    "click",
    function () {
        console.log("start");
        file = input.files[0];

        const formData = new FormData();
        formData.append("title", "email");
        formData.append("date", "12/12/2012");
        formData.append("location", "password");
        formData.append('image', file);
        formData.append("csrf_token", CSRF_TOKEN);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/public/object/storeImage");

        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                console.log(this.status);
                if (this.status === 201) {
                    console.log("fone");
                } else {
                    alert("hehe");
                }
            }
        };
    }
);
