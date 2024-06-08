<?php
session_start();
include '../controller/db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['title']); ?></title>
    <link rel="stylesheet" href="../CSS/news.css">
    <script src="https://kit.fontawesome.com/90c067ab0f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>News</h1>
            <div class="nav">
                <a href="news_upload.php"><button>Create News</button></a>
                <?php if (isset($_SESSION['username'])): ?>
                    <form action="../controller/control.php" method="post">
                        <button class="log" type="submit" name="action" value="logout">Log Out</button>
                    </form>
                <?php else: ?>
                    <a href="../auth/login.php"><button>Login</button></a>
                    <a href="../auth/register.php"><button>Register</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="news-detail">
            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
            <img class="news-img" src="<?php echo htmlspecialchars($row['image']); ?>" alt="News Image">
            <p>By <?php echo htmlspecialchars($row['author']); ?> on <?php echo htmlspecialchars($row['date_created']); ?></p>
            <p style="word-wrap: break-word; text-align: justify; text-justify: inter-word;"><?php echo (htmlspecialchars($row['description'])); ?></p>
            <a href="../index.php" class="back-link">Back to Home</a>
        </div>
    </div>

    <div class="footer">
        <p>&copy; Tugas Berita Kinan Radiaputra</p>
    </div>
</body>
</html>