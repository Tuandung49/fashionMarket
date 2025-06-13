const accountForm = document.getElementById('accountForm');

accountForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Validate form
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if (password !== confirmPassword) {
        alert('Mật khẩu không khớp!');
        return;
    }

    if (password.length < 6) {
        alert('Mật khẩu phải có ít nhất 6 ký tự!');
        return;
    }

    // Tạo FormData
    const formData = new FormData(accountForm);

    // Lấy user_type từ select
    const userType = document.getElementById('user_type').value;
    formData.set('user_type', userType); // Đảm bảo đúng giá trị 0 hoặc 1

    // Gửi dữ liệu
    fetch('add_account.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.status === 'success') {
                    alert('Thêm tài khoản thành công!');
                    accountForm.reset();
                    window.location.href = 'manage_accounts.php';
                } else {
                    alert('Lỗi: ' + data.message);
                }
            } catch (e) {
                alert('Lỗi server: ' + text);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi khi thêm tài khoản');
        });
});