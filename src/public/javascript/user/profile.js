const fullname = document.getElementById("name");
const username = document.getElementById("username");
const logOutButton = document.querySelector("#log-out");

function openPopUp(object) {
    object.parentElement.parentElement.children[1].style.display = "flex";
}

function closePopUp(object) {
    object.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].style.display = "none";
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