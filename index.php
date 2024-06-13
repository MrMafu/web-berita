<?php
session_start();
include 'controller/db.php';

$sql = "SELECT * FROM news ORDER BY date_created DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/90c067ab0f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-200 m-0 p-0 flex flex-col min-h-screen">

    <!-- Header -->
    <div class="bg-white py-2 text-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <h1 class="font-bold text-xl md:text-4xl">
                <i class="fa-solid fa-newspaper text-[#1DA1F2]"></i> News
            </h1>
            <div class="flex items-center space-x-1 text-xs md:text-sm">
                <?php if (isset($_SESSION['username'])) : ?>
                    <a href="main/dashboard.php" class="text-white bg-[#1DA1F2] border-none rounded px-2 md:px-4 py-2 m-1 md:m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">
                        <i class="fa-solid fa-clipboard-user"></i> ‎ Profile
                    </a>
                <?php else : ?>
                    <a href="auth/login.php" class="text-white bg-[#1DA1F2] border-none rounded px-2 md:px-4 py-2 m-1 md:m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">
                        <i class="fa-solid fa-user-check"></i> ‎ Login
                    </a>
                    
                    <a href="auth/register.php" class="text-white bg-[#1DA1F2] border-none rounded px-2 md:px-4 py-2 m-1 md:m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">
                        <i class="fa-solid fa-user-plus"></i> ‎ Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Main -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 my-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 flex-grow">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="bg-white p-4 border border-gray-300 rounded shadow-sm">
                <h4 class="max-w-full overflow-hidden text-ellipsis whitespace-nowrap text-lg font-semibold mb-2">
                    <?php echo htmlspecialchars($row['title']); ?>
                </h4>

                <img class="aspect-video w-full object-cover rounded mb-2" src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="News Image">

                <p class="max-w-full overflow-hidden text-ellipsis whitespace-nowrap text-sm text-gray-600 mb-1">
                    By <span class="text-[#1DA1F2]"><?php echo htmlspecialchars($row['author']); ?></span>
                </p>

                <p class="max-w-full overflow-hidden text-ellipsis whitespace-nowrap text-sm text-gray-600 mb-1">
                    <?php echo htmlspecialchars($row['date_created']); ?>
                </p>

                <p class="max-w-full overflow-hidden text-ellipsis whitespace-nowrap text-sm text-black mb-1">
                    <?= htmlspecialchars($row['description']); ?>
                </p>

                <a class="text-sm text-white bg-[#1DA1F2] px-4 py-2 rounded transition-colors duration-300 hover:bg-[#0d8ae6] mt-1 mb-2 inline-block" href="main/news_detail.php?id=<?php echo $row['id']; ?>">
                    <i class="fa-solid fa-book-open"></i> ‎ Read more
                </a>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Footer -->
    <div class="bg-white py-2 text-center mt-auto">
        <p>&copy; Tugas Berita Kinan Radiaputra</p>
    </div>
</body>
</html>