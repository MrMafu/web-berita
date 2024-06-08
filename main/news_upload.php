<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload News</title>
    <link rel="stylesheet" href="../CSS/auth.css">
    <script src="https://kit.fontawesome.com/90c067ab0f.js" crossorigin="anonymous"></script>
</head>
<body>
    <h2>Upload News</h2>
    <a href="../index.php"><button><i class="fa-solid fa-chevron-left"></i></button></a>
    <form class="field" action="../controller/control_news.php" method="post" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" name="title" required><br>
        <label for="image">Image</label>
        <input type="file" name="image" accept="image/*" required><br>
        <label for="description">Description</label>
        <textarea name="description" required></textarea><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>