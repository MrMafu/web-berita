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
    echo "You do not have permission to edit this news.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $new_image = $_FILES['image']['name'];

    if ($new_image) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($new_image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $sql = "UPDATE news SET title='$title', description='$description', image='$target_file' WHERE id=$id";
    } else {
        $sql = "UPDATE news SET title='$title', description='$description' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "News updated successfully.";
        header("Location: ../index.php");
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
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/90c067ab0f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-200 m-0 p-0 flex items-center justify-center h-screen">
    <div class="w-full max-w-5xl mx-auto bg-white p-7.5 rounded-lg shadow transition-shadow duration-300 hover:shadow-lg p-5">
        <div class="flex justify-center items-center mb-5 space-x-2">
            <a href="profile.php">
                <button class="text-[#1DA1F2] text-2xl cursor-pointer">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </a>
            <h2 class="text-2xl font-bold">Edit News</h2>
        </div>
        <form class="flex flex-col" action="" method="post" enctype="multipart/form-data">
            <label for="title" class="text-sm"><i class="fa-solid fa-font text-[#1DA1F2]"></i> Title</label>
            <input class="border border-gray-300 rounded w-full p-2.5 mb-3.75 transition-border duration-300 focus:border-[#1DA1F2] focus:outline-none text-sm" type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
            <label for="image" class="text-sm"><i class="fa-solid fa-image text-[#1DA1F2]"></i> Image</label>
            <input class="border border-gray-300 rounded w-full p-2.5 mb-3.75 transition-border duration-300 focus:border-[#1DA1F2] focus:outline-none text-sm" type="file" name="image" accept="image/*"><br>
            <label for="description" class="text-sm"><i class="fa-regular fa-message text-[#1DA1F2]"></i> Description</label>
            <textarea style="resize: none;" class="border border-gray-300 rounded w-full p-2.5 mb-3.75 transition-border duration-300 focus:border-[#1DA1F2] focus:outline-none text-sm h-40" name="description" required><?php echo $row['description']; ?></textarea><br>
            <button class="border-none rounded bg-[#1DA1F2] text-white cursor-pointer p-2.5 mb-2.5 transition-colors duration-300 hover:bg-[#0d8ae6]" type="submit">Update</button>
        </form>
    </div>
</body>
</html>