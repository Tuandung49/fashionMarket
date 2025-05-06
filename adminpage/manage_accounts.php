<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <title>ACCOUNT MANAGEMENT</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="search-bar">
        <div class="search-input">
            <input type="text" id="searchInput" placeholder="Search by name or email..." />
            <button onclick="filterAccounts()">Search</button>
        </div>

        <div class="role-filter">
            <label><input type="radio" name="role" value="all" checked onchange="filterAccounts()"> ALL </label>
            <label><input type="radio" name="role" value="buyer" onchange="filterAccounts()"> BUYER </label>
            <label><input type="radio" name="role" value="seller" onchange="filterAccounts()"> SELLER </label>
        </div>
    </div>

    <table class="account-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="accountTableBody"></tbody>
        <?php
        // Kết nối database
        $conn = new mysqli("localhost", "root", "", "ten_database_cua_ban");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Truy vấn dữ liệu
        $sql = "SELECT * FROM accounts"; // Đảm bảo tên bảng đúng
        $result = $conn->query($sql);

        // Kiểm tra lỗi truy vấn
        if (!$result) {
            die("Lỗi truy vấn: " . $conn->error);
        }
        ?>

        <!-- Hiển thị dữ liệu -->
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['role'] ?></td>
                <td>
                    <button>Edit</button>
                    <button>Delete</button>
                </td>
            </tr>
        <?php } ?>

    </table>

    <div id="pagination"></div>

    <script src="script.js"></script>
</body>

</html>