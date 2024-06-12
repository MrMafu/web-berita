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
            <a href="dashboard.php">
                <button class="text-[#1DA1F2] text-2xl cursor-pointer">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </a>
            <h2 class="text-2xl font-bold">Upload News</h2>
        </div>
        <form class="flex flex-col" action="../controller/control_news.php" method="post" enctype="multipart/form-data">
            <label for="title" class="text-sm"><i class="fa-solid fa-font text-[#1DA1F2]"></i> Title</label>
            <input class="border border-gray-300 rounded w-full p-2.5 mb-3.75 transition-border duration-300 focus:border-[#1DA1F2] focus:outline-none text-sm" type="text" name="title" required><br>
            <label for="image" class="text-sm"><i class="fa-solid fa-image text-[#1DA1F2]"></i> Image</label>
            <input class="border border-gray-300 rounded w-full p-2.5 mb-3.75 transition-border duration-300 focus:border-[#1DA1F2] focus:outline-none text-sm" type="file" name="image" accept="image/*" required><br>
            <label for="description" class="text-sm"><i class="fa-regular fa-message text-[#1DA1F2]"></i> Description</label>
            <textarea style="resize: none;" class="border border-gray-300 rounded w-full p-2.5 mb-3.75 transition-border duration-300 focus:border-[#1DA1F2] focus:outline-none text-sm h-40" name="description" required></textarea><br>
            <button class="border-none rounded bg-[#1DA1F2] text-white cursor-pointer p-2.5 mb-2.5 transition-colors duration-300 hover:bg-[#0d8ae6] text-sm" type="submit">Upload</button>
        </form>
    </div>
</body>
</html>