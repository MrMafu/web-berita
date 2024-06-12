<?php
session_start();
include 'controller/db.php';

$sql = "SELECT * FROM news ORDER BY date_created DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <div class="bg-white py-2 text-center">
        <div class="container mx-auto w-4/5 flex items-center justify-between">
            <h1 class="font-bold text-4xl"><i class="fa-solid fa-newspaper text-[#1DA1F2]"></i> News</h1>
            <div class="flex items-center space-x-1 text-sm">
                <?php if (isset($_SESSION['username'])) : ?>
                    <a href="main/news_upload.php" class="text-white bg-[#1DA1F2] border-none rounded px-4 py-2 m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">Create News ‎<i class="fa-solid fa-plus"></i></a>
                    <form action="controller/control.php" method="post" class="m-0">
                        <button class="text-white bg-red-600 border-none rounded px-4 py-2 m-2 cursor-pointer transition-colors duration-300 hover:bg-red-700" type="submit" name="action" value="logout">Log Out ‎<i class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                <?php else : ?>
                    <a href="auth/login.php" class="text-white bg-[#1DA1F2] border-none rounded px-4 py-2 m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">Login</a>
                    <a href="auth/register.php" class="text-white bg-[#1DA1F2] border-none rounded px-4 py-2 m-2 transition-colors duration-300 hover:bg-[#0d8ae6]">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container mx-auto w-4/5 my-8 grid grid-cols-3 gap-4 flex-grow">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="bg-white p-4 border border-gray-300 rounded shadow-sm">
                <h4 class="max-w-full overflow-hidden text-ellipsis whitespace-nowrap text-lg font-semibold mb-2"><?php echo htmlspecialchars($row['title']); ?></h4>
                <img class="aspect-video w-full object-cover rounded mb-2" src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="News Image">
                <p class="max-w-full overflow-hidden text-ellipsis whitespace-nowrap text-sm text-gray-600 mb-1">By <span class="text-[#1DA1F2]"><?php echo htmlspecialchars($row['author']); ?></span></p>
                <p class="max-w-full overflow-hidden text-ellipsis whitespace-nowrap text-sm text-gray-600 mb-1"><?php echo htmlspecialchars($row['date_created']); ?></p>
                <p class="max-w-full overflow-hidden text-ellipsis whitespace-nowrap text-sm text-black mb-2"><?= htmlspecialchars($row['description']); ?></p>
                <div class="flex justify-between items-center">
                    <a class="text-sm text-white bg-[#1DA1F2] px-4 py-2 rounded transition-colors duration-300 hover:bg-[#0d8ae6]" href="main/news_detail.php?id=<?php echo $row['id']; ?>">Read more</a>
                    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === $row['author']) : ?>
                        <div class="flex gap-2">
                            <a class="text-sm text-white bg-green-400 px-4 py-2 rounded transition-colors duration-300 hover:bg-green-600" href="main/news_edit.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button onclick="konfirmasi(<?php echo $row['id']; ?>)" class="text-sm text-white bg-red-600 px-4 py-2 rounded transition-colors duration-300 hover:bg-red-800"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="bg-white py-2 text-center mt-auto">
        <p>&copy; Tugas Berita Kinan Radiaputra</p>
    </div>

    <script>
        function konfirmasi(id) {
            if(confirm("Anda yakin ingin menghapus berita ini?") == true) {
                location.replace('main/news_delete.php?id=' + id)
            } else {
                location.replace('index.php')
            }
        }
    </script>
</body>
</html>