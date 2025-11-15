<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id=? ORDER BY due_date ASC");
$stmt->execute([$_SESSION["user_id"]]);
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>To-Do App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/style.css">
</head>

<body>

<nav class="navbar navbar-custom">
    <div class="container d-flex justify-content-between">
        <span class="navbar-brand">🌈 Xin chào, <?= $_SESSION["username"] ?></span>
        <a href="logout.php" class="btn-neon">Đăng xuất</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-white">Danh sách công việc</h3>
        <a href="add_task.php" class="btn-neon">+ Thêm</a>
    </div>

    <?php foreach($tasks as $t): ?>
        <div class="card-custom mb-3">

            <h4><?= $t["title"] ?></h4>

            <div class="badge-status <?= $t["status"] ?> mt-2">
                <?= $t["status"] ?>
            </div>

            <p class="mt-3"><?= nl2br($t["description"]) ?></p>
            <p>📅 Hạn: <?= $t["due_date"] ?></p>

            <a href="edit_task.php?id=<?= $t["id"] ?>" class="btn-neon btn-sm">Sửa</a>
            <a onclick="return confirm('Xóa công việc này?')" 
               href="delete_task.php?id=<?= $t["id"] ?>" 
               class="btn-neon btn-sm" 
               style="background:#ff4d4d;">Xóa</a>
        </div>
    <?php endforeach; ?>

</div>
</body>
</html>
