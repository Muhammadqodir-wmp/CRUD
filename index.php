<?php
require 'db.php';
require "includes/navbar.php";

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Foydalanuvchilar</h2>
<a href="create.php">Yangi foydalanuvchi qo'shish</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <a href="update.php?id=<?= $user['id'] ?>">Tahrirlash</a>
                <a href="delete.php?id=<?= $user['id'] ?>">O'chirish</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
