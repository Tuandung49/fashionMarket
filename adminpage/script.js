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
    if (!tableBody) return;

    tableBody.innerHTML = '';
    const startIndex = (currentPage - 1) * itemsPerPage;

    accounts.slice(startIndex, startIndex + itemsPerPage).forEach((account, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${startIndex + index + 1}</td>
            <td>${account.name}</td>
            <td>${account.email}</td>
            <td>${account.role}</td>
            <td>
                <button class="edit-btn" data-id="${account.user_id}">Edit</button>
                <button class="delete-btn" data-id="${account.user_id}">Delete</button>
            </td>`;
        tableBody.appendChild(row);
    });

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            editAccount(this.getAttribute('data-id'));
        });
    });

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            deleteAccount(this.getAttribute('data-id'));
        });
    });
}

function renderPagination() {
    const paginationDiv = document.getElementById('pagination');
    paginationDiv.innerHTML = '';

    const totalPages = Math.ceil(accounts.length / itemsPerPage);
    if (totalPages <= 1) return;

    const prevBtn = document.createElement('button');
    prevBtn.className = 'page-nav prev';
    prevBtn.innerHTML = `
        <svg viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>
        <span>Previous</span>
    `;
    prevBtn.disabled = currentPage === 1;
    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
            renderPagination();
        }
    });
    paginationDiv.appendChild(prevBtn);

    for (let i = 1; i <= totalPages; i++) {
        const pageLink = document.createElement('button');
        pageLink.textContent = i;
        if (i === currentPage) {
            pageLink.classList.add('active');
        }
        pageLink.addEventListener('click', () => {
            currentPage = i;
            renderTable();
            renderPagination();
        });
        paginationDiv.appendChild(pageLink);
    }

    const nextBtn = document.createElement('button');
    nextBtn.className = 'page-nav next';
    nextBtn.innerHTML = `
        <span>Next</span>
        <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
    `;
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
            renderPagination();
        }
    });
    paginationDiv.appendChild(nextBtn);
}

function deleteAccount(userId) {
    const numericId = parseInt(userId);
    if (isNaN(numericId) || numericId <= 0) {
        alert('ID tài khoản không hợp lệ');
        return;
    }

    if (!confirm(`Bạn có chắc chắn muốn xóa tài khoản #${numericId}?`)) {
        return;
    }

    fetch('delete_accounts.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${numericId}`
    })
    .then(response => {
        if (!response.ok) throw new Error('Lỗi kết nối');
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            accounts = accounts.filter(acc => acc.user_id != numericId);
            renderTable();
        } else {
            throw new Error(data.message || 'Lỗi không xác định');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Lỗi khi xóa tài khoản: ' + error.message);
    });
}

function editAccount(userId) {
    const numericId = parseInt(userId);
    if (isNaN(numericId)) {
        alert("ID tài khoản không hợp lệ");
        return;
    }

    const account = accounts.find(acc => acc.user_id == numericId);
    if (!account) {
        alert('Không tìm thấy tài khoản');
        return;
    }

    const newRole = prompt(
        `Chỉnh sửa role cho ${account.name} (Hiện tại: ${account.role})\nNhập: buyer, seller hoặc admin`,
        account.role
    );

    if (newRole && newRole !== account.role) {
        const validRoles = ['buyer', 'seller', 'admin'];
        if (!validRoles.includes(newRole.toLowerCase())) {
            alert('Role không hợp lệ! Vui lòng nhập buyer, seller hoặc admin');
            return;
        }

        const formData = new FormData();
        formData.append('id', numericId);
        formData.append('role', newRole.toLowerCase());

        fetch('update_role.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) throw new Error('Lỗi network');
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    const accountIndex = accounts.findIndex(acc => acc.user_id == numericId);
                    if (accountIndex !== -1) {
                        accounts[accountIndex].role = newRole.toLowerCase();
                        renderTable();
                        alert('Cập nhật thành công!');
                    }
                } else {
                    throw new Error(data.message || 'Lỗi không xác định từ server');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi khi cập nhật: ' + error.message);
            });
    }
}

// Xử lý submit form thêm tài khoản (nếu có form trên trang này)
document.addEventListener('DOMContentLoaded', function () {
    fetchAccounts();
});