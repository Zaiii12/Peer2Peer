<?php
session_start();

$admin_username = 'admin';
$admin_password = 'adminpassword';

function is_admin_logged_in() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['is_admin'] = true;
        header('Location: admin.php');
    } else {
        $login_error = "Invalid username or password.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

if (basename($_SERVER['PHP_SELF']) === 'admin.php') {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit();
    }
}
?>