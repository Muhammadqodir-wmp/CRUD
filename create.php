<?php
require 'db.php';
require "includes/navbar.php";

// POST so'rovi bilan yuborilgan ma'lumotlarni saqlash
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ma'lumotlarni tozalash
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Xatoliklarni tekshirish
    if (!$name || !$email) {
        $error = "Iltimos, barcha maydonlarni to'ldiring!";
    } else {
        // Ma'lumotlarni bazaga saqlash
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->execute(['name' => $name, 'email' => $email]);

        // Saqlash muvaffaqiyatli bo'lsa, foydalanuvchini bosh sahifaga yo'naltirish
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yangi foydalanuvchi qo'shish</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
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
    </style>
</head>
<body>

    <div class="container">
        <h2>Yangi foydalanuvchi qo'shish</h2>

        <!-- Xatolik xabarini ko'rsatish -->
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="">
            <div>
                <label for="name">Ism:</label>
                <input type="text" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <button type="submit">Saqlash</button>
        </form>
    </div>

</body>
</html>
