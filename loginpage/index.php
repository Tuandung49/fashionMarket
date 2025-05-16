<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập & Đăng ký</title>
  <script>
    function switchTab(tab) {
      document.getElementById('form-login').classList.remove('active');
      document.getElementById('form-register').classList.remove('active');
      document.getElementById('tab-login').classList.remove('active');
      document.getElementById('tab-register').classList.remove('active');
      document.getElementById(`form-${tab}`).classList.add('active');
      document.getElementById(`tab-${tab}`).classList.add('active');
    }

    const pass = document.getElementById('pass');
    const repass = document.getElementById('repass');
    const msg = document.getElementById('msg');

    repass.addEventListener('input', () => {
      if (repass.value === "") {
        repass.classList.remove('valid', 'invalid');
        msg.style.display = "none";
        return;
      }

      if (repass.value === pass.value) {
        repass.classList.add('valid');
        repass.classList.remove('invalid');
        msg.style.display = "none";
      } else {
        repass.classList.add('invalid');
        repass.classList.remove('valid');
        msg.style.display = "block";
      }
    });
    function loginSubmit(e){
      e.stopPropagation();
      e.preventDefault();
      console.log(e.target)
      const formData = new FormData(e.target);

      fetch('login.php', {
        method: 'POST',
        body: formData
      })
      .then(res => {
        console.log(res.status)
        if (res.status === 200){
          return res.text();
        }
        throw new Error(res.statusText)
      })
      // .then(res => res.text())
      .then(data => {
        window.location.href = '../accountpage/account.php';
      })
      .catch(e => alert(e.message));
    }
    function validateRegister() {
      if (pass.value !== repass.value) {
        msg.style.display = "block";
        return false;
      }
      return true;
    }
  </script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
  <div class="tabs">
    <div id="tab-login" class="active" onclick="switchTab('login')">Đăng nhập</div>
    <div id="tab-register" onclick="switchTab('register')">Đăng ký</div>
  </div>

  <!-- Đăng nhập -->
  <form id="form-login" class="active" onsubmit='loginSubmit(event)'>
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <button type="submit">Đăng nhập</button>
  </form>

  <!-- Đăng ký -->
  <form id="form-register" onsubmit="return validateRegister()">
    <input type="text" name="fullname" placeholder="Tên đầy đủ" required>
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" id="pass" name="password" placeholder="Mật khẩu" required>
    <input type="password" id="repass" placeholder="Xác nhận mật khẩu" required>
    <div class="msg" id="msg">Mật khẩu không khớp</div>
    <button type="submit">Đăng ký</button>
  </form>
</div>


<script>
  // Gửi dữ liệu ĐĂNG KÝ
  document.getElementById('form-register').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append('password', document.getElementById('pass').value);

    fetch('register.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(data => {
      if (data === 'success') {
        alert('Đăng ký thành công!');
        switchTab('login');
      } else {
        alert(data);
      }
    });
  });

  // Gửi dữ liệu ĐĂNG NHẬP
  // document.getElementById('form-login').addEventListener('submit', function(e) {
  //   e.preventDefault();

  //   const formData = new FormData(this);

  //   fetch('login.php', {
  //     method: 'POST',
  //     body: formData
  //   })
  //   .then(res => res.text())
  //   .then(data => {
  //     if (data === 'success') {
  //       window.location.href = 'home.php';
  //     } else {
  //       alert(data);
  //     }
  //   });
  // });
</script>

</body>
</html>
