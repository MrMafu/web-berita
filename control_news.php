<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}

$title = $_POST['title'];
$image = $_FILES['image']['name'];
$description = $_POST['description'];
$author = $_SESSION['username'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($image);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
    $sql = "INSERT INTO news (title, image, author, description) VALUES ('$title', '$target_file', '$author', '$description')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading image.";
}

$conn->close();
?>