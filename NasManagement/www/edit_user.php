<?php
$username = $_GET['username'];
$users = json_decode(file_get_contents('../data/users.json'), true);
$user = array_filter($users, fn($u) => $u['username'] == $username)[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $directory = "/srv/nas/users/$new_username";
    
    foreach ($users as &$u) {
        if ($u['username'] == $username) {
            $u['username'] = $new_username;
            $u['directory'] = $directory;
            break;
        }
    }
    file_put_contents('../data/users.json', json_encode($users));
    
    shell_exec("../scripts/edit_user.sh $username $new_username $directory");
    
    header('Location: users.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <button type="submit">Save</button>
        </form>
        <a href="users.php">Back to List</a>
    </div>
</body>
</html>
