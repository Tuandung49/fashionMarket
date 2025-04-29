
let accounts = [];
let currentPage = 1;
const itemsPerPage = 5;

function fetchAccounts() {
    const search = document.getElementById('searchInput').value;
    const role = document.querySelector('input[name="role"]:checked').value;

    let url = `accounts.php?search=${encodeURIComponent(search)}&role=${encodeURIComponent(role)}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            accounts = data;
            currentPage = 1;
            renderTable();
            renderPagination();
        })
        .catch(error => console.error("Error:", error));
}

function filterAccounts() {
    fetchAccounts();
}

function renderTable() {
    const tableBody = document.getElementById('accountTableBody');
    tableBody.innerHTML = '';

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageData = accounts.slice(start, end);

    pageData.forEach(account => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${account.name}</td>
            <td>${account.email}</td>
            <td>${account.role}</td>
            <td>
                <button onclick="edit('${account.id}')">Edit</button>
                <button onclick="remove('${account.id}')">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function renderPagination() {
    const paginationDiv = document.getElementById('pagination');
    paginationDiv.innerHTML = '';

    const totalPages = Math.ceil(accounts.length / itemsPerPage);

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.innerText = i;
        if (i === currentPage) btn.classList.add('active');
        btn.onclick = () => {
            currentPage = i;
            renderTable();
        };
        paginationDiv.appendChild(btn);
    }
}

function edit(id) {
    alert("Edit user " + id);
}

function remove(id) {
    alert("Delete user " + id);
}

window.onload = function () {
    fetchAccounts();
}
