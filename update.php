<?php
session_start();
require 'db.php';
require "includes/navbar.php";

// ID ni olish va tekshirish
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    die("Noto'g'ri ID!");
}

// Foydalanuvchini olish
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Foydalanuvchi topilmadi!");
}

// Ma'lumotni yangilash
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($name && $email) {
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'id' => $id
        ]);

        $_SESSION['success'] = "Foydalanuvchi ma'lumotlari muvaffaqiyatli yangilandi!";
        header("Location: index.php");
        exit;
    } else {
        $error = "Barcha maydonlarni to'ldirish majburiy!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchini yangilash</title>
</head>
<body>
    <h2>Foydalanuvchini yangilash</h2>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <div>
            <label for="name">Ism:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <button type="submit">Yangilash</button>
    </form>
</body>
</html>
