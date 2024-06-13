<?php
session_start();
include '../controller/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM news WHERE author = ? ORDER BY date_created DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
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

                    <form action="controller/control.php" method="post" class="m-0">
                        <button class="text-white bg-red-600 border-none rounded px-2 md:px-4 py-2 m-1 md:m-2 cursor-pointer transition-colors duration-300 hover:bg-red-700" type="submit" name="action" value="logout">
                            <i class="fa-solid fa-right-from-bracket"></i> ‎ Log Out
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main -->
    <div class="container mx-auto w-4/5 my-8 flex-grow">
        <h1 class="text-2xl font-bold text-center mb-4">
            <i class="fa-solid fa-clipboard-user text-[#1DA1F2]"></i> Your Profile
        </h1>
        <p class="text-center font-semibold">Welcome, <span class="text-[#1DA1F2]"><?php echo htmlspecialchars($username); ?></span></p>
        <div class="mb-4 text-xs md:text-base">
            <a href="news_upload.php" class="text-white bg-[#1DA1F2] px-4 py-2 rounded transition-colors duration-300 hover:bg-[#0d8ae6]">
                <i class="fa-solid fa-upload"></i> ‎ Upload News
            </a>
        </div>
        <div class="overflow-x-auto">

            <!-- Dashboard Table -->
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Title</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Image</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Author</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Description</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                <?php echo htmlspecialchars(substr($row['title'], 0, 20)) . (strlen($row['title']) > 20 ? '...' : ''); ?>
                            </td>

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <img class="aspect-video w-20 object-cover" src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="News Image">
                            </td>

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo htmlspecialchars($row['author']); ?></td>

                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php echo htmlspecialchars(substr($row['description'], 0, 50)) . (strlen($row['description']) > 50 ? '...' : ''); ?>
                            </td>
                            
                            <td class="whitespace-nowrap p-4 flex gap-2">
                                <a href="news_edit.php?id=<?php echo $row['id']; ?>" class="inline-block rounded bg-green-400 px-4 py-2 transition-colors duration-300 text-xs font-medium text-white hover:bg-green-500">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button onclick="confirmation(<?php echo $row['id']; ?>)" class="inline-block rounded bg-red-600 px-4 py-2 transition-colors duration-300 text-xs font-medium text-white hover:bg-red-700">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>

    <!-- Footer -->
    <div class="bg-white py-2 text-center mt-auto">
        <p>&copy; Tugas Berita Kinan Radiaputra</p>
    </div>

    <!-- Delete Confirmation -->
    <script>
        function confirmation(id) {
            if(confirm("Are you sure you want to delete this?") == true) {
                location.replace('news_delete.php?id=' + id)
            } else {
                location.replace('dashboard.php')
            }
        }
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>