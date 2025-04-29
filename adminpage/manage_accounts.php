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
    </table>

    <div id="pagination"></div>

    <script src="script.js"></script>
</body>

</html>