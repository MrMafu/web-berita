<?php $msg = (isset($_GET['msg']) ? $_GET['msg']: ""); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="w-full max-w-lg mx-auto bg-white p-7.5 rounded-lg shadow transition-shadow duration-300 hover:shadow-lg p-5">
        <div class="flex justify-center items-center mb-5 space-x-2">
            <a href="../index.php">
                <button class="text-[#1DA1F2] text-2xl cursor-pointer">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </a>
            <h2 class="text-2xl font-bold">Login</h2>
        </div>
        <form class="flex flex-col" action="../controller/control.php" method="post">
            <label for="username" class="text-sm"><i class="fa-solid fa-user text-[#1DA1F2]"></i> Username</label>
            <input class="border border-gray-300 rounded w-full p-2.5 mb-3.75 transition-border duration-300 focus:border-[#1DA1F2] focus:outline-none text-sm" type="text" name="username" required>
            <label for="password" class="text-sm"><i class="fa-solid fa-lock text-[#1DA1F2]"></i> Password</label>
            <input class="border border-gray-300 rounded w-full p-2.5 mb-3.75 transition-border duration-300 focus:border-[#1DA1F2] focus:outline-none text-sm" type="password" name="password" required>
            <button class="border-none mt-4 rounded bg-[#1DA1F2] text-white cursor-pointer p-2.5 mb-2.5 transition-colors duration-300 hover:bg-[#0d8ae6] text-sm" type="submit" name="action" value="login">Login</button>
            <h4 class="text-sm">Don't have an account? <a class="text-[#1DA1F2] no-underline transition-colors duration-300 hover:text-blue-700" href="register.php">Register</a></h4>
        </form>
        <?= (!empty($msg) ? "<h2 class='text-red-500 text-center mt-4'>$msg</h2>" : "") ?>
    </div>
</body>
</html>