<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $directory = "/srv/nas/users/$username";
    
    $users = json_decode(file_get_contents('../data/users.json'), true);
    $users[] = ['username' => $username, 'directory' => $directory];
    file_put_contents('../data/users.json', json_encode($users));
    
    shell_exec("../scripts/add_user.sh $username $directory");
    
    header('Location: users.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Add User</h1>
        <form method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <button type="submit">Add User</button>
        </form>
        <a href="users.php">Back to List</a>
    </div>
</body>
</html>
