const currentUser = document.querySelector("#current-admin");
const currentFullname = document.querySelector("#current-fullname");
const currentUsername = document.querySelector("#current-username");

const usernameInput = document.querySelector("#username");
const fullnameInput = document.querySelector("#fullname");
const passwordInput = document.querySelector("#password");
const passwordConfirmedInput = document.querySelector("#confirm-password");

const usernameAlert = document.querySelector("#username-alert");
const fullnameAlert = document.querySelector("#fullname-alert");
const passwordAlert = document.querySelector("#password-alert");

const usernameConfirmButton = document.querySelector("#username-confirm");
const fullnameConfirmButton = document.querySelector("#fullname-confirm");
const passwordConfirmButton = document.querySelector("#password-confirm");
const deleteButton = document.querySelector("#delete-button");

const fullnameRegex = /^[a-zA-Z ]+$/;
const usernameRegex = /^\w+$/;
const passwordRegex = /^\w+$/;

let usernameValid = false;
let fullnameValid = false;
let passwordValid = false;
let passwordConfirmedValid = false;

window.addEventListener(
    "load",
    debounce(() => {
        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/user/dataByUsername?username=${USERNAME}&csrf_token=${CSRF_TOKEN}`
        );
        
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const data = JSON.parse(this.responseText);
                currentUser.innerText = "Admin @" + data['username'];
                currentFullname.innerText = "Current Name: " + data['fullname'];
                currentUsername.innerText = "Current Username: " + data['username'];
            }
        };
    }, DEBOUNCE_TIMEOUT)
);

deleteButton &&
    deleteButton.addEventListener("click", async (e) => {
        e.preventDefault();
        const xhr = new XMLHttpRequest();

        xhr.open("POST", `/public/admin/delete`);

        const formData = new FormData();
        formData.append("username", USERNAME);
        formData.append("csrf_token", CSRF_TOKEN);
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                window.location.href = "/public/admin/admins";
            }
        };
    });

usernameInput &&
    usernameInput.addEventListener(
        "keyup",
        debounce(() => {
            const username = usernameInput.value;

            const xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                `/public/user/username?username=${username}&csrf_token=${CSRF_TOKEN}`
            );

            xhr.send();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 200) {
                        usernameAlert.innerText = "Username already exists!";
                        usernameAlert.className = "alert-show";
                        usernameValid = false;
                    } else if (!usernameRegex.test(username)) {
                        usernameAlert.innerText = "Invalid username format!";
                        usernameAlert.className = "alert-show";
                        usernameValid = false;
                    } else {
                        usernameAlert.innerText = "";
                        usernameAlert.className = "alert-hide";
                        usernameValid = true;
                    }
                }
            };
        }, DEBOUNCE_TIMEOUT)
    );

usernameConfirmButton &&
    usernameConfirmButton.addEventListener("click", async (e) => {
        if (usernameValid) {
            const username = usernameInput.value;

            const formData = new FormData();
            formData.append("username", USERNAME);
            formData.append("new_username", username);
            formData.append("csrf_token", CSRF_TOKEN);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/public/user/updateUsernameByUsername");

            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 201) {
                        window.location.href = "/public/admin/admin/" + username;
                    }
                }
            };
        } else {
            e.preventDefault();
            usernameAlert.innerText = "Please fill out a valid username first!";
            usernameAlert.className = "alert-show";
        }
    });

fullnameInput &&
    fullnameInput.addEventListener(
        "keyup",
        debounce(() => {
            const fullname = fullnameInput.value;

            if (!fullnameRegex.test(fullname)) {
                fullnameAlert.innerText = "Invalid fullname format!";
                fullnameAlert.className = "alert-show";
                fullnameValid = false;
            } else {
                fullnameAlert.innerText = "";
                fullnameAlert.className = "alert-hide";
                fullnameValid = true;
            }
        }, DEBOUNCE_TIMEOUT)
    );

fullnameConfirmButton &&
    fullnameConfirmButton.addEventListener("click", async (e) => {
        if (fullnameValid) {
            const fullname = fullnameInput.value;

            const formData = new FormData();
            formData.append("username", USERNAME);
            formData.append("fullname", fullname);
            formData.append("csrf_token", CSRF_TOKEN);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/public/user/updateFullnameByUsername");

            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 201) {
                        window.location.reload();
                    }
                }
            };
        } else {
            e.preventDefault();
            fullnameAlert.innerText = "Please fill out a valid fullname first!";
            fullnameAlert.className = "alert-show";
        }
    });

passwordInput &&
    passwordInput.addEventListener(
        "keyup",
        debounce(() => {
            const password = passwordInput.value;

            if (!passwordRegex.test(password)) {
                passwordAlert.innerText = "Invalid password format!";
                passwordAlert.className = "alert-show";
                passwordValid = false;
            } else {
                passwordAlert.innerText = "";
                passwordAlert.className = "alert-hide";
                passwordValid = true;
            }
        }, DEBOUNCE_TIMEOUT)
    );

passwordConfirmedInput &&
    passwordConfirmedInput.addEventListener(
        "keyup",
        debounce(() => {
            const password = passwordInput.value;
            const passwordConfirmed = passwordConfirmedInput.value;

            if (password !== passwordConfirmed) {
                passwordAlert.innerText =
                    "Confirmed password doesn't match!";
                passwordAlert.className = "alert-show";
                passwordConfirmedValid = false;
            } else {
                passwordAlert.innerText = "";
                passwordAlert.className = "alert-hide";
                passwordConfirmedValid = true;
            }
        }, DEBOUNCE_TIMEOUT)
    );

passwordConfirmButton &&
    passwordConfirmButton.addEventListener("click", async (e) => {
        if (passwordValid && passwordConfirmedValid) {
            const password = passwordInput.value;

            const formData = new FormData();
            formData.append("username", USERNAME);
            formData.append("password", password);
            formData.append("csrf_token", CSRF_TOKEN);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/public/user/updatePasswordByUsername");

            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 201) {
                        window.location.reload();
                    }
                }
            };
        } else {
            e.preventDefault();
            passwordAlert.innerText =
                "Please fill out a valid password first!";
            passwordAlert.className = "alert-show";
        }
    });