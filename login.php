<?php $msg = (isset($_GET['msg']) ? $_GET['msg']: ""); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/style.css">
    <script src="https://kit.fontawesome.com/90c067ab0f.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Login</h1>
    <a href="index.php"><button><i class="fa-solid fa-chevron-left"></i></button></a>
    <form class="field" action="control.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit" name="action" value="login">Login</button>
        <h4>Don't have an account? <a href="register.php">Register</a></h4>
    </form>
    <?= (!empty($msg) ? "<h2>Error: $msg</h2>" : "") ?>
</body>
</html>