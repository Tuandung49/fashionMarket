document.addEventListener('DOMContentLoaded', function () {
    // Xử lý chuyển đổi giữa admin và seller
    const typeButtons = document.querySelectorAll('.type-btn');
    const accountTypeField = document.getElementById('accountType');

    typeButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const type = this.getAttribute('data-type');

            // Cập nhật giao diện
            typeButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Cập nhật loại tài khoản
            accountTypeField.value = type;

            // Cập nhật tiêu đề form
            document.querySelector('h1').textContent = `Thêm ${type === 'admin' ? 'Admin' : 'Seller'}`;
        });
    });

    // Xử lý submit form
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

        // Xác định user_type
        const accountType = formData.get('accountType');
        const userType = accountType === 'admin' ? 2 : 1;
        formData.append('user_type', userType);

        // Gửi dữ liệu
        fetch('add_account.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Thêm tài khoản thành công!');
                    accountForm.reset();
                } else {
                    alert('Lỗi: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi thêm tài khoản');
            });
    });
});