<?php
session_start();
require "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        header("Location: login.php");
    } catch (PDOException $e) {
        $msg = "Tên đăng nhập hoặc email đã tồn tại!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/style.css">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card-custom" style="max-width:420px;width:100%;">
        <h2 class="text-center mb-4">✨ Tạo tài khoản</h2>

        <?php if ($msg): ?>
            <div class='alert alert-danger bg-opacity-75'><?= $msg ?></div>
        <?php endif; ?>

        <form method="POST">
            <label class="form-label text-white">Tên đăng nhập</label>
            <input type="text" class="form-control mb-3" name="username" required>

            <label class="form-label text-white">Email</label>
            <input type="email" class="form-control mb-3" name="email">

            <label class="form-label text-white">Mật khẩu</label>
            <input type="password" class="form-control mb-3" name="password" required>

            <button class="btn-neon w-100">Đăng ký</button>
        </form>

        <div class="text-center mt-3">
            <a href="login.php" class="text-white">Đã có tài khoản? Đăng nhập</a>
        </div>
    </div>
</div>

</body>
</html>
