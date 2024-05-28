<?php
$users = json_decode(file_get_contents('/srv/nas/NasManagement/data/users.json'), true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>User List</h1>
        <a href="add_user.php">Add User</a>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Directory</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['directory']) ?></td>
                        <td>
                            <a href="edit_user.php?username=<?= urlencode($user['username']) ?>">Edit</a> |
                            <a href="delete_user.php?username=<?= urlencode($user['username']) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
