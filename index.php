<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM news ORDER BY date_created DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="CSS/berita.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>News</h1>
            <div class="nav">
                <a href="news_upload.php"><button>Create News</button></a>
                <?php if (isset($_SESSION['username'])): ?>
                    <form action="control.php" method="post">
                        <button class="log" type="submit" name="action" value="logout">Log Out</button>
                    </form>
                <?php else: ?>
                    <a href="login.php"><button>Login</button></a>
                    <a href="register.php"><button>Register</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="news-item">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="News Image">
                <p>By <?php echo htmlspecialchars($row['author']); ?> on <?php echo htmlspecialchars($row['date_created']); ?></p>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <a href="news_detail.php?id=<?php echo $row['id']; ?>">Read more</a>
                <?php if (isset($_SESSION['username']) && $_SESSION['username'] === $row['author']): ?>
                    <div class="news-actions">
                        <a href="news_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="news_delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
    
    <div class="footer">
        <p>&copy; Tugas Berita Kinan Radiaputra</p>
    </div>
</body>
</html>