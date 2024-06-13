<?php
session_start();
include '../controller/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['title']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/90c067ab0f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .custom-text-justify {
            text-align: justify;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }
        .news-description {
            white-space: pre-wrap;
        }
        @media (max-width: 640px) {
            .container {
                max-width: 100%;
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .news-detail {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</head>
<body class="bg-gray-200 m-0 p-0">

    <!-- Header -->
    <div class="bg-white py-2 text-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <a href="../index.php">
                <h1 class="font-bold text-xl md:text-4xl cursor-pointer transition-colors duration-300 hover:text-[#1DA1F2]">
                    <i class="fa-solid fa-newspaper text-[#1DA1F2]"></i> News
                </h1>
            </a>
            <div class="flex items-center space-x-1 text-xs md:text-sm">
                <?php if (isset($_SESSION['username'])) : ?>
                    <a href="dashboard.php" class="text-white bg-[#1DA1F2] border-none rounded px-2 md:px-4 py-2 m-1 md:m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">
                        <i class="fa-solid fa-clipboard-user"></i> ‎ Profile
                    </a>
                <?php else : ?>
                    <a href="../auth/login.php" class="text-white bg-[#1DA1F2] border-none rounded px-2 md:px-4 py-2 m-1 md:m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">
                        <i class="fa-solid fa-user-check"></i> ‎ Login
                    </a>
                    
                    <a href="../auth/register.php" class="text-white bg-[#1DA1F2] border-none rounded px-2 md:px-4 py-2 m-1 md:m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">
                        <i class="fa-solid fa-user-plus"></i> ‎ Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Detail News -->
    <div class="container mx-auto my-8 sm:px-6 lg:px-8">
        <div class="news-detail bg-white p-4 border border-gray-300 rounded shadow-sm">
            <h2 class="text-xl font-semibold mb-4 break-words"><?php echo htmlspecialchars($row['title']); ?></h2>

            <img class="aspect-video w-full h-auto object-cover rounded mb-4" src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="News Image">

            <p class="text-sm text-gray-600 mb-2">By <span class="text-[#1DA1F2]"><?php echo htmlspecialchars($row['author']); ?></span> on <?php echo htmlspecialchars($row['date_created']); ?></p>

            <p class="text-sm text-black mb-4 break-words text-justify custom-text-justify news-description"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer bg-white py-2 text-center">
        <p>&copy; Tugas Berita Kinan Radiaputra</p>
    </div>
</body>
</html>

<?php
$conn->close();
?>