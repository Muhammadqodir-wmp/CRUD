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
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchini yangilash</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
        }

        form {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Foydalanuvchini yangilash</h2>

    <!-- Xato xabari -->
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- Muvaffaqiyatli yangilashdan so'ng xabar -->
    <?php if (isset($_SESSION['success'])): ?>
        <p class="success"><?= $_SESSION['success'] ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Form -->
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
