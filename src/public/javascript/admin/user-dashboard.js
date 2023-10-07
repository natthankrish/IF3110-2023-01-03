const prevButton = document.querySelector("#prev-button");
const nextButton = document.querySelector("#next-button");
const usersList = document.querySelector(".users-list");
const paginationText = document.querySelector("#pagination-text")
const pageNumber = document.querySelector("#page-number");
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
            `/public/user/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`
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
            `/public/user/fetch/${currentPage}?csrf_token=${CSRF_TOKEN}`
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
    searchInput.addEventListener("keyup", async (e) => {
        if (e.keyCode === 13) {
            const searchValue = searchInput.value;

            // If search value is empty, reload
            if (searchValue == "") {
                window.location.reload();
            } else {
                const xhr = new XMLHttpRequest();
                xhr.open(
                    "GET",
                    `/public/user/filter/${searchValue}?csrf_token=${CSRF_TOKEN}`
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
        }
    });

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
    const tableBody = document.getElementById("userTableBody");
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
            <th>Storage Usage</th>
            <th></th>
        </tr>
    `;

    let i = currentPage * ROWS_PER_PAGE - (ROWS_PER_PAGE - 1);

    // Update the table body with new data
    data.users.forEach((user) => {
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>${i}</td>
            <td>${user.fullname}</td>
            <td>${user.username}</td>
            <td>${user.email}</td>
            <td>${((user.storage - user.storage_left) / 1024).toFixed(2)} GB</td>
            <td class="button-column"><a href="/public/admin/user/${user.username}" class="button">Manage Account</a></td>
        `;
        tableBody.appendChild(newRow);

        i++;
    });

    pageNumber.innerHTML = currentPage;
};    