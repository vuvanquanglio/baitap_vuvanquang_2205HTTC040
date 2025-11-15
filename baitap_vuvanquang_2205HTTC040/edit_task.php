<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) header("Location: login.php");

$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id=? AND user_id=?");
$stmt->execute([$id, $_SESSION["user_id"]]);
$task = $stmt->fetch();

if (!$task) die("Không tìm thấy công việc!");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE tasks SET title=?,description=?,due_date=?,status=? WHERE id=?");
    $stmt->execute([$_POST["title"],$_POST["description"],$_POST["due_date"],$_POST["status"],$id]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa công việc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/style.css">
</head>

<body>

<div class="container mt-5" style="max-width:700px;">
    <div class="card-custom">
        <h3 class="mb-3">✏️ Sửa công việc</h3>

        <form method="POST">

            <label class="form-label text-white">Tiêu đề</label>
            <input type="text" class="form-control mb-3" name="title" value="<?= $task['title'] ?>">

            <label class="form-label text-white">Mô tả</label>
            <textarea class="form-control mb-3" name="description"><?= $task['description'] ?></textarea>

            <label class="form-label text-white">Hạn</label>
            <input type="date" class="form-control mb-3" name="due_date" value="<?= $task['due_date'] ?>">

            <label class="form-label text-white">Trạng thái</label>
            <select name="status" class="form-select mb-3">
                <option value="pending" <?= $task["status"]=="pending"?"selected":"" ?>>Pending</option>
                <option value="in_progress" <?= $task["status"]=="in_progress"?"selected":"" ?>>In Progress</option>
                <option value="completed" <?= $task["status"]=="completed"?"selected":"" ?>>Completed</option>
            </select>

            <button class="btn-neon">Cập nhật</button>
            <a href="index.php" class="btn btn-light ms-2">Quay lại</a>
        </form>
    </div>
</div>

</body>
</html>
