<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload News</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h2>Upload News</h2>
    <form class="field" action="control_news.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br>
        <input type="file" name="image" accept="image/*" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>