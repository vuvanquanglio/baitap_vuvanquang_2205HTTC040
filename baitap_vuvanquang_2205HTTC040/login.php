<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/style.css">
</head><?php
session_start();
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: index.php");
        exit;
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card-custom" style="max-width:400px;width:100%;">
        <h2 class="text-center mb-4">🔥 Đăng nhập</h2>

        <?php if ($error): ?>
            <div class='alert alert-danger bg-opacity-75'><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <label class="form-label text-white">Tài khoản</label>
            <input type="text" class="form-control mb-3" name="username" required>

            <label class="form-label text-white">Mật khẩu</label>
            <input type="password" class="form-control mb-3" name="password" required>

            <button class="btn-neon w-100">Đăng nhập</button>
        </form>

        <div class="text-center mt-3">
            <a href="register.php" class="text-white">Chưa có tài khoản? Đăng ký</a>
        </div>
    </div>
</div>

</body>
</html>


<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card-custom" style="max-width: 420px; width:100%;">
        <h2 class="text-center mb-4 text-white">🔥 Đăng nhập</h2>

        <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">
            <div class="mb-3 text-white">
                <label class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" name="username" required>
            </div>

            <div class="mb-3 text-white">
                <label class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button class="btn-neon w-100 mt-3">Đăng nhập</button>
        </form>

        <p class="text-center mt-3">
            <a href="register.php" class="text-white">Tạo tài khoản mới</a>
        </p>
    </div>
</div>

</body>
</html>
