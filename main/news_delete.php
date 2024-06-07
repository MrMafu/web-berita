<?php
session_start();
include '../controller/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/welcome.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SESSION['username'] !== $row['author']) {
    echo "You do not have permission to delete this news.";
    exit();
}

$sql = "DELETE FROM news WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: ../index.php");
} else {
    echo "Error deleting news: " . $conn->error;
}
$conn->close();
?>