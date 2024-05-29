<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

if (empty($username)) {
    header("Location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    
</body>
</html>