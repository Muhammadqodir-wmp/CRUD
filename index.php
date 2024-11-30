<?php
// db.php faylini ulash
require 'db.php';
require "includes/navbar.php";

// Foydalanuvchilarni ma'lumotlar bazasidan olish
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchilar Ro'yxati</title>
    <style>
        /* Umumiy stil */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        /* Jadvalni stilizatsiya qilish */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Linklar uchun stil */
        a {
            color: #4CAF50;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #4CAF50;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        a:hover {
            background-color: #4CAF50;
            color: white;
        }

        /* Yangi foydalanuvchi qo'shish tugmasi */
        .add-user-link {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 18px;
        }

        .add-user-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Foydalanuvchilar</h2>
    <a href="create.php" class="add-user-link">Yangi foydalanuvchi qo'shish</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <a href="update.php?id=<?= $user['id'] ?>">Tahrirlash</a>
                        <a href="delete.php?id=<?= $user['id'] ?>">O'chirish</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Foydalanuvchilar mavjud emas</td>
            </tr>
        <?php endif; ?>
    </table>

</body>
</html>
