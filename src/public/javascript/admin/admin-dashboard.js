const fullnameInput = document.querySelector("#fullname");
const usernameInput = document.querySelector("#username");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");
const passwordConfirmedInput = document.querySelector("#confirm-password");
const registrationForm = document.querySelector(".registration-form");
const fullnameAlert = document.querySelector("#fullname-alert");
const usernameAlert = document.querySelector("#username-alert");
const emailAlert = document.querySelector("#email-alert");
const passwordAlert = document.querySelector("#password-alert");
const passwordConfirmedAlert = document.querySelector(
    "#confirm-password-alert"
);

const fullnameRegex = /^[a-zA-Z ]+$/;
const usernameRegex = /^\w+$/;
const emailRegex =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const passwordRegex = /^\w+$/;

let fullnameValid = false;
let usernameValid = false;
let emailValid = false;
let passwordValid = false;
let passwordConfirmedValid = false;

function openAddAdmin(object) {
    object.parentElement.children[1].style.display = "flex";
  }
  
  function closeAddAdmin(object) {
    object.parentElement.parentElement.parentElement.parentElement.style.display =
      "none";
  }

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

emailInput &&
    emailInput.addEventListener(
        "keyup",
        debounce(() => {
            const email = emailInput.value;

            const xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                `/public/user/email?email=${email}&csrf_token=${CSRF_TOKEN}`
            );

            xhr.send();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 200) {
                        emailAlert.innerText = "Email already exists!";
                        emailAlert.className = "alert-show";
                        emailValid = false;
                    } else if (!emailRegex.test(email)) {
                        emailAlert.innerText = "Invalid email format!";
                        emailAlert.className = "alert-show";
                        emailValid = false;
                    } else {
                        emailAlert.innerText = "";
                        emailAlert.className = "alert-hide";
                        emailValid = true;
                    }
                }
            };
        }, DEBOUNCE_TIMEOUT)
    );

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
                passwordConfirmedAlert.innerText =
                    "Confirmed password doesn't match!";
                passwordConfirmedAlert.className = "alert-show";
                passwordConfirmedValid = false;
            } else {
                passwordConfirmedAlert.innerText = "";
                passwordConfirmedAlert.className = "alert-hide";
                passwordConfirmedValid = true;
            }
        }, DEBOUNCE_TIMEOUT)
    );

registrationForm &&
    registrationForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        if (!fullnameValid) {
            e.preventDefault();
            fullnameAlert.innerText = "Please fill out a valid fullname first!";
            fullnameAlert.className = "alert-show";
        } else {
            fullnameAlert.className = "alert-hide";
        }

        if (!usernameValid) {
            e.preventDefault();
            usernameAlert.innerText = "Please fill out a valid username first!";
            usernameAlert.className = "alert-show";
        } else if (!usernameValid) {
            usernameAlert.className = "alert-show";
        } else {
            usernameAlert.className = "alert-hide";
        }

        if (!emailValid) {
            e.preventDefault();
            emailAlert.innerText = "Please fill out a valid email first!";
            emailAlert.className = "alert-show";
        } else if (!emailValid) {
            emailAlert.className = "alert-show";
        } else {
            emailAlert.className = "alert-hide";
        }

        if (!passwordValid) {
            e.preventDefault();
            passwordAlert.innerText = "Please fill out a valid password first!";
            passwordAlert.className = "alert-show";
        } else if (!passwordValid) {
            passwordAlert.className = "alert-show";
        } else {
            passwordAlert.className = "alert-hide";
        }

        if (!passwordConfirmedValid) {
            e.preventDefault();
            passwordConfirmedAlert.innerText =
                "Confirmed password doesn't match!";
            passwordConfirmedAlert.className = "alert-show";
        } else {
            passwordConfirmedAlert.className = "alert-hide";
        }

        if (
            !fullnameValid ||
            !usernameValid ||
            !emailValid ||
            !passwordValid ||
            !passwordConfirmedValid
        ) {
            return;
        }

        const fullname = fullnameInput.value;
        const username = usernameInput.value;
        const email = emailInput.value;
        const password = passwordInput.value;

        const formData = new FormData();
        formData.append("fullname", fullname);
        formData.append("email", email);
        formData.append("username", username);
        formData.append("password", password);
        formData.append("csrf_token", CSRF_TOKEN);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/public/admin/registerAdmin");

        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 201) {
                    window.location.reload();
                } else {
                    alert("An error occured, please try again!");
                }
            }
        };
    });


const prevButton = document.querySelector("#prev-button");
const nextButton = document.querySelector("#next-button");
const adminsList = document.querySelector(".admins-list");
const paginationText = document.querySelector("#pagination-text");
const buttonColumn = document.querySelector(".button-column");
const searchInput = document.querySelector("#search");

let currentPage = 1;

prevButton &&
    prevButton.addEventListener("click", async () => {
        if (currentPage === 1) {
            /* Tidak bisa kembali */
            return;
        }

        currentPage -= 1;

        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/admin/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`
        );

        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    const data = JSON.parse(this.responseText);
                    updateData(data);
                } else {
                    alert("An error occured, please try again!");
                }
            }
        };
    });

nextButton &&
    nextButton.addEventListener("click", async () => {
        if (currentPage === PAGES) {
            /* Tidak bisa next */
            return;
        }

        currentPage += 1;

        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/admin/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`
        );

        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    const data = JSON.parse(this.responseText);
                    updateData(data);
                } else {
                    alert("An error occured, please try again!");
                }
            }
        };
    });

searchInput &&
    searchInput.addEventListener(
        "keyup",
        debounce(() => {
            const searchValue = searchInput.value;

            // If search is empty, reload
            if (searchValue == "") {
                window.location.reload();
                return;
            } else {
                const xhr = new XMLHttpRequest();
                xhr.open(
                    "GET",
                    `/public/admin/filter/${searchValue}?csrf_token=${CSRF_TOKEN}`
                );

                xhr.send();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 200) {
                            const data = JSON.parse(this.responseText);
                            updateData(data);
                            hidePagination();
                        } else {
                            alert("An error occured, please try again!");
                        }
                    }
                };
            }

        }, DEBOUNCE_TIMEOUT)
    );

const hidePagination = () => {
    if (prevButton) {
        prevButton.style.display = "none";
    }
    if (nextButton) {
        nextButton.style.display = "none";
    }
    if (paginationText) {
        paginationText.style.display = "none";
    }
};

const updateData = (data) => {
    const table = document.querySelector("table");
    const tableBody = document.getElementById("adminTableBody");
    const pageNumber = document.querySelector("#page-number");

    // Clear the existing rows in the table body
    tableBody.innerHTML = "";

    // Update the table header
    table.querySelector("thead").innerHTML = `
        <tr>
            <th style="width: 30px">No</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th></th>
        </tr>
    `;

    let i = currentPage * ROWS_PER_PAGE - (ROWS_PER_PAGE - 1);

    // Update the table body with new data
    data.admins.forEach((admin) => {
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>${i}</td>
            <td>${admin.fullname}</td>
            <td>${admin.username}</td>
            <td>${admin.email}</td>
            <td class="button-column"><a href="/public/admin/admin/${admin.username}" class="button">Manage Account</a></td>
        `;
        tableBody.appendChild(newRow);

        i++;
    });

    pageNumber.innerHTML = currentPage;
};