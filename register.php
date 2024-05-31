<?php $msg = (isset($_GET['msg']) ? $_GET['msg']: ""); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php"><button>Home</button></a>
    <h1>Register</h1>
    <form class="field" action="control.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit" name="action" value="register">Register</button>
        <h4>Already have an account? <a href="login.php">Login</a></h4>
    </form>
</body>
</html>