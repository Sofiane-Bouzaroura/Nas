<?php
$username = $_GET['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = json_decode(file_get_contents('../data/users.json'), true);
    $users = array_filter($users, fn($u) => $u['username'] != $username);
    file_put_contents('../data/users.json', json_encode($users));
    
    shell_exec("../scripts/delete_user.sh $username");
    
    header('Location: users.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Delete User</h1>
        <p>Are you sure you want to delete this user?</p>
        <form method="post">
            <button type="submit">Delete</button>
            <a href="users.php">Cancel</a>
        </form>
    </div>
</body>
</html>
