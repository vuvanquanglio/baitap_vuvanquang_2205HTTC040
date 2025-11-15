<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) header("Location: login.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO tasks(user_id,title,description,due_date) VALUES (?,?,?,?)");
    $stmt->execute([$_SESSION["user_id"], $_POST["title"], $_POST["description"], $_POST["due_date"]]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm công việc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/style.css">
</head>

<body>

<div class="container mt-5" style="max-width:700px;">
    <div class="card-custom">
        <h3 class="mb-3">📝 Thêm công việc</h3>

        <form method="POST">
            <label class="form-label text-white">Tiêu đề</label>
            <input type="text" class="form-control mb-3" name="title" required>

            <label class="form-label text-white">Mô tả</label>
            <textarea class="form-control mb-3" name="description"></textarea>

            <label class="form-label text-white">Hạn</label>
            <input type="date" class="form-control mb-3" name="due_date">

            <button class="btn-neon">Lưu</button>
            <a href="index.php" class="btn btn-light ms-2">Quay lại</a>
        </form>
    </div>
</div>

</body>
</html>
