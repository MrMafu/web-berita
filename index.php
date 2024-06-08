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
    <link rel="stylesheet" href="CSS/news.css">
    <script src="https://kit.fontawesome.com/90c067ab0f.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="header">
        <div class="container">
            <h1><i class="fa-solid fa-newspaper"></i> News</h1>
            <div class="nav">
                <?php if (isset($_SESSION['username'])) : ?>
                    <a href="main/news_upload.php"><button>Create News ‎ <i class="fa-solid fa-plus"></i></button></a>
                    <form action="controller/control.php" method="post">
                        <button class="log" type="submit" name="action" value="logout">Log Out</button>
                    </form>
                <?php else : ?>
                    <a href="auth/login.php"><button>Login</button></a>
                    <a href="auth/register.php"><button>Register</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container news-list">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="news-item">
                <h4 class="news-title"><?php echo htmlspecialchars($row['title']); ?></h4>
                <img class="news-img" src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="News Image">
                <p class="news-sub">By <?php echo htmlspecialchars($row['author']); ?></p>
                <p class="news-sub"><?php echo htmlspecialchars($row['date_created']); ?></p>
                <p class="news-desc"><?= htmlspecialchars($row['description']); ?></p>
                <div class="news-actions">
                    <a class="news-read-btn" href="main/news_detail.php?id=<?php echo $row['id']; ?>">Read more</a>
                    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === $row['author']) : ?>
                        <div class="news-actions-buttons">
                            <a class="news-edit-btn" href="main/news_edit.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button onclick="konfirmasi(<?php echo $row['id']; ?>)" class="news-delete-btn"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="footer">
        <p>&copy; Tugas Berita Kinan Radiaputra</p>
    </div>
</body>
<script>
    function konfirmasi(id) {
        if(confirm("Anda yakin ingin menghapus berita ini?") == true) {
            location.replace('main/news_delete.php?id=' + id)
        } else {
            location.replace('index.php')
        }
    }
</script>
</html>