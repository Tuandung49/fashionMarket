<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <title>ACCOUNT MANAGEMENT</title>
    <link rel="stylesheet" href="style.css" />
    <div class="page-header">
        <h1>Account Management</h1>
        <div class="action-buttons">
            <a href="../homePage/HomePage.php" class="add-btn">Trang chủ</a>
            <a href="add_account.html" class="add-btn">Thêm tài khoản</a>
        </div>
    </div>
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
            <label><input type="radio" name="role" value="admin" onchange="filterAccounts()"> ADMIN </label>
        </div>
    </div>

    <table class="account-table">
        <thead>
            <tr>
                <th style="width: 60px; text-align: center">STT</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th style="width: 150px">Actions</th>
            </tr>
        </thead>
        <tbody id="accountTableBody">

        </tbody>
    </table>

    <form id="addAccountForm" class="account-form">
    </form>
    <div id="pagination"></div>

    <script src="script.js"></script>
</body>

</html>