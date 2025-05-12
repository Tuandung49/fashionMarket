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
            <td>${account.first_name} ${account.last_name}</td>
            <td>${account.email}</td>
            <td>${account.role}</td>
            <td>
                <button onclick="edit('${account.user_id}')">Edit</button>
                <button onclick="remove('${account.user_id}')">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function renderPagination() {
    const paginationDiv = document.getElementById('pagination');
    paginationDiv.innerHTML = '';

    const totalPages = Math.ceil(accounts.length / itemsPerPage);

    // Thêm nút Previous (←)
    if (currentPage > 1) {
        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '← Previous';
        prevBtn.classList.add('pagination-btn');
        prevBtn.onclick = () => {
            currentPage--;
            renderTable();
            renderPagination(); // Cập nhật lại phân trang
        };
        paginationDiv.appendChild(prevBtn);
    }

    // Các nút số trang (giữ nguyên)
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

    // Thêm nút Next (→)
    if (currentPage < totalPages) {
        const nextBtn = document.createElement('button');
        nextBtn.innerHTML = 'Next →';
        nextBtn.classList.add('pagination-btn');
        nextBtn.onclick = () => {
            currentPage++;
            renderTable();
            renderPagination(); // Cập nhật lại phân trang
        };
        paginationDiv.appendChild(nextBtn);
    }
}

function edit(userId) {
    alert("Edit user " + id);
}

function remove(userId) {
    alert("Delete user " + id);
}

window.onload = function () {
    fetchAccounts();
}

function remove(userId) {
    if (confirm("Bạn có chắc chắn muốn xóa tài khoản này không?")) {
        fetch("delete_accounts.php", {  // Sửa tên file thành delete_accounts.php
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `user_id=${userId}`,
        })
            .then((res) => res.text())
            .then((msg) => {
                if (msg === "success") {
                    alert("Xóa thành công!");
                    fetchAccounts(); // Cập nhật lại bảng
                } else {
                    alert(`Xóa thất bại! Lỗi: ${msg}`); // Hiển thị lỗi từ server
                }
            })
            .catch((error) => console.error("Lỗi:", error));
    }
}


function edit(userId) {
    const newRole = prompt("Nhập role mới (buyer hoặc seller):").toLowerCase();

    if (newRole !== 'buyer' && newRole !== 'seller') {
        alert("Giá trị role không hợp lệ!");
        return;
    }

    fetch("update_role.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `user_id=${userId}&role=${newRole}`
    })
        .then(res => res.text())
        .then(msg => {
            if (msg === "success") {
                alert("Cập nhật thành công!");
                fetchAccounts(); // Refresh danh sách
            } else {
                alert("Cập nhật thất bại!");
            }
        });
}
