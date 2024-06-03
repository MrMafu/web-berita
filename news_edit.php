<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SESSION['username'] !== $row['author']) {
    echo "You do not have permission to edit this news.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $new_image = $_FILES['image']['name'];

    if ($new_image) {
        // If a new image is uploaded
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($new_image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $sql = "UPDATE news SET title='$title', description='$description', image='$target_file' WHERE id=$id";
    } else {
        // If no new image is uploaded
        $sql = "UPDATE news SET title='$title', description='$description' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "News updated successfully.";
        header("Location: index.php");
    } else {
        echo "Error updating news: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h2>Edit News</h2>
    <form class="field" action="" method="post" enctype="multipart/form-data">
        <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
        <textarea name="description" required><?php echo $row['description']; ?></textarea><br>
        <input type="file" name="image" accept="image/*"><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>