<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php"><button>Home</button></a>
    <h1>Login</h1>
    <form class="field" action="control.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit" name="action" value="login">Login</button>
        <h4>Don't have an account? <a href="register.php">Register</a></h4>
    </form>
</body>
</html>