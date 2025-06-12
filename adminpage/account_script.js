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
        .then(response => {
            // Debug: kiểm tra response có phải JSON không
            return response.text().then(text => {
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error('Server response is not valid JSON:', text);
                    alert('Lỗi server: ' + text);
                    throw e;
                }
            });
        })
        .then(data => {
            if (data.status === 'success') {
                alert('Thêm tài khoản thành công!');
                accountForm.reset();
                window.location.href = 'manage_accounts.php'; // Chuyển hướng sau khi thêm
            } else {
                alert('Lỗi: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi khi thêm tài khoản');
        });
});