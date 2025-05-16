<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../loginpage/index.php');
    exit;
}

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT fullname, email FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý tài khoản</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Thông tin cá nhân:</h1>
    <p><strong>Họ và tên:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Tên đăng nhập:</strong> <?php echo htmlspecialchars($username); ?></p>

    <hr>

    <section>
      <h2>Cập nhật thông tin</h2>
      <form action="update_info.php" method="POST">
        <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required placeholder="Họ và tên">
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required placeholder="Email">
        <button type="submit">Lưu thay đổi</button>
      </form>
    </section>

    <section>
      <h2>Đổi mật khẩu</h2>
      <form action="change_password.php" method="POST">
        <input type="password" name="old_password" required placeholder="Mật khẩu hiện tại">
        <input type="password" name="new_password" required placeholder="Mật khẩu mới">
        <button type="submit">Đổi mật khẩu</button>
      </form>
    </section>

    <section>
      <h2>Xóa tài khoản</h2>
      <form action="delete_account.php" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này?');">
        <button type="submit" class="danger">XÓA TÀI KHOẢN</button>
      </form>
    </section>

    <div class="footer">
      <a href="../homePage/HomePage.php">Trang chủ</a>
    </div>
  </div>
</body>
</html>
