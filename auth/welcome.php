<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/90c067ab0f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-200 m-0 p-0 flex flex-col items-center justify-center min-h-screen">
    <div class="w-full max-w-lg mx-auto bg-white p-7.5 rounded-lg shadow transition-shadow duration-300 hover:shadow-lg p-5 text-center">
        <h1 class="text-2xl md:text-4xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p class="text-lg mb-6">You have successfully logged in.</p>
        <a href="../index.php" class="text-white bg-[#1DA1F2] border-none rounded px-4 py-2 m-1 transition-colors duration-300 hover:bg-[#0d8ae6]"><i class="fa-solid fa-home"></i> Go to Homepage</a>
    </div>
</body>
</html>