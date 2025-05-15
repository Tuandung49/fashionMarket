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



window.onload = function () {
    fetchAccounts();
}

function remove(userId) {
    if (confirm("Bạn có chắc chắn muốn xóa?")) {
        // Đảm bảo userId là số
        const numericId = parseInt(userId);
        if (isNaN(numericId)) {
            alert("ID không hợp lệ!");
            return;
        }
        // Sử dụng FormData để chuẩn hóa dữ liệu
        const formData = new FormData();
        formData.append('id', numericId);

        fetch("delete_accounts.php", {
            method: "POST",
            body: formData // Không cần header khi dùng FormData
        })
        .then(res => res.text())
        .then(msg => {
            console.log("Response:", msg);
            if (msg.trim() === "success") {
                alert("Xóa thành công!");
                fetchAccounts();
            } else {
                alert(`Lỗi: ${msg}`);
            }
        })
        .catch(err => console.error("Lỗi:", err));
    }
}

function edit(userId) {
    const currentRole = accounts.find(acc => acc.user_id == userId)?.role; // Lấy role hiện tại
    const newRole = prompt(`Nhập role mới (current: ${currentRole}):\n(buyer hoặc seller)`, currentRole)?.toLowerCase();

    if (!newRole || !['buyer', 'seller'].includes(newRole)) {
        alert("Role phải là 'buyer' hoặc 'seller'");
        return;
    }

    fetch("update_role.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `id=${userId}&role=${newRole}`
    })
        .then(res => res.text())
        .then(msg => {
            alert(msg.includes("success") ? "Thành công!" : msg);
            if (msg.includes("success")) fetchAccounts();
        })
        .catch(err => alert("Lỗi kết nối: " + err));
}