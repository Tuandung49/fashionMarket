let accounts = [];
let currentPage = 1;
const itemsPerPage = 7;

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
// Bảng hiển thị
function renderTable() {
    const tableBody = document.getElementById('accountTableBody');
    if (!tableBody) return; // Thêm kiểm tra null

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

    // Thêm event listener mới
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
// Phân trang
function renderPagination() {
    const paginationDiv = document.getElementById('pagination');
    paginationDiv.innerHTML = '';

    const totalPages = Math.ceil(accounts.length / itemsPerPage);
    if (totalPages <= 1) return;

    // Nút Previous
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

    // Các nút trang
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

    // Nút Next
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
// Hàm xóa tài khoản
function deleteAccount(userId) {
    // Chuyển đổi sang số và validate
    const numericId = parseInt(userId);
    
    if (isNaN(numericId) || numericId <= 0) {
        alert('ID tài khoản không hợp lệ');
        return;
    }

    if (!confirm(`Bạn có chắc chắn muốn xóa tài khoản #${numericId}?`)) {
        return;
    }

    fetch('delete_account.php', {
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
            // Cập nhật giao diện
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
// Hàm thay đổi role của tài khoản
function editAccount(userId) {
    // Chuyển đổi userId sang số để đảm bảo kiểu dữ liệu
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
        // Validate role input
        const validRoles = ['buyer', 'seller', 'admin'];
        if (!validRoles.includes(newRole.toLowerCase())) {
            alert('Role không hợp lệ! Vui lòng nhập buyer, seller hoặc admin');
            return;
        }

        // Tạo FormData để gửi dữ liệu
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
                    // Cập nhật local data
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

// Hàm validate form
function validateForm(formData) {
    // Kiểm tra password và confirm password
    if (formData.get('password') !== formData.get('confirm_password')) {
        return { isValid: false, message: 'Mật khẩu không khớp' };
    }

    // Kiểm tra độ dài password
    if (formData.get('password').length < 6) {
        return { isValid: false, message: 'Mật khẩu phải có ít nhất 6 ký tự' };
    }

    // Kiểm tra email hợp lệ
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(formData.get('email'))) {
        return { isValid: false, message: 'Email không hợp lệ' };
    }

    return { isValid: true };
}


// Hàm mở modal với loại tài khoản tương ứng
function openAddAccountModal(accountType) {
    const modal = document.getElementById('addAccountModal');
    const modalTitle = document.getElementById('modalTitle');
    const accountTypeField = document.getElementById('accountType');
    const levelField = document.getElementById('levelField');

    // Đặt tiêu đề modal
    modalTitle.textContent = `Add New ${accountType.charAt(0).toUpperCase() + accountType.slice(1)} `;

    // Lưu loại tài khoản vào hidden field
    accountTypeField.value = accountType;

    // Hiển thị level field nếu là admin hoặc seller
    if (accountType === 'admin' || accountType === 'seller') {
        levelField.style.display = 'block';
    } else {
        levelField.style.display = 'none';
    }

    modal.style.display = 'block';
}

// Xử lý submit form
document.getElementById('addAccountForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    // Validate form
    const validation = validateForm(formData);
    if (!validation.isValid) {
        alert(validation.message);
        return;
    }

    // Xác định user_type dựa trên accountType
    const accountType = formData.get('accountType');
    let userType;
    switch (accountType) {
        case 'buyer': userType = 0; break;
        case 'seller': userType = 1; break;
        case 'admin': userType = 2; break;
        default: userType = 0;
    }
    // Thêm user_type vào formData
    formData.append('user_type', userType);

    // Gửi dữ liệu
    // Trong phần xử lý submit form thêm tài khoản
    fetch('add_account.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) throw new Error('Lỗi network');
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                // Thêm tài khoản mới vào danh sách hiện tại
                const newAccount = {
                    user_id: data.user_id, // Sử dụng ID từ server
                    name: formData.get('first_name') + ' ' + (formData.get('last_name') || ''),
                    email: formData.get('email'),
                    role: formData.get('accountType'),
                    user_type: formData.get('accountType') === 'admin' ? 2 : 1
                };

                accounts.unshift(newAccount); // Thêm vào đầu mảng
                renderTable(); // Render lại bảng

                alert('Thêm tài khoản thành công!');
                form.reset();
            } else {
                throw new Error(data.message || 'Lỗi không xác định');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Lỗi khi thêm tài khoản: ' + error.message);
        });
});

//Thêm event listener thay vì dùng onclick inline
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addAccountForm');
    if (form) { // Thêm kiểm tra null
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            // Xử lý submit
        });
    }

    // Load dữ liệu ban đầu
    fetchAccounts();
});