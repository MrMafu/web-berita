<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'register') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (!empty($username) && !empty($password)) {
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
            
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            if (mysqli_query($conn, $query)) {
                header("Location: welcome.php");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Username and Password cannot be empty";
        }
    }

    if ($action == 'login') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (!empty($username) && !empty($password)) {
            $username = mysqli_real_escape_string($conn, $username);
            $query = "SELECT password FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if ($password == $row['password']) {
                    $_SESSION['username'] = $username;
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Invalid username or password";
                }
            } else {
                echo "Invalid username or password";
            }
        } else {
            echo "Username and Password cannot be empty";
        }
    }

    if ($action == 'logout') {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
?>