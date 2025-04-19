<?php
session_start();
require_once 'dbconnect.php';

if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
    } else {
        $error = "Invalid credentials.";
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: admin.php");
    exit;
}

if (isset($_GET['approve']) && isset($_SESSION['admin_id'])) {
    $id = $_GET['approve'];
    $pdo->prepare("UPDATE tutors SET status = 'approved' WHERE id = ?")->execute([$id]);
    header("Location: admin.php");
    exit;
}

if (isset($_GET['deny']) && isset($_SESSION['admin_id'])) {
    $id = $_GET['deny'];
    $pdo->prepare("UPDATE tutors SET status = 'denied' WHERE id = ?")->execute([$id]);
    header("Location: admin.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
<?php if (!isset($_SESSION['admin_id'])): ?>
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input name="username" placeholder="Username" required><br>
        <input name="password" type="password" placeholder="Password" required><br>
        <button type="submit" name="action" value="login">Login</button>
    </form>
<?php else: ?>
    <h2>Admin Dashboard</h2>
    <a href="admin.php?action=logout">Logout</a>

    <h3>Statistics</h3>
    <?php
        $userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        echo "<p>Total users signed up: $userCount</p>";
    ?>

    <h3>Pending Tutor Signups</h3>
    <?php
        $tutors = $pdo->query("SELECT * FROM tutors WHERE status = 'pending'")->fetchAll();
        if (count($tutors) === 0) echo "<p>No pending tutors.</p>";
        foreach ($tutors as $tutor): ?>
        <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
            <strong>Name:</strong> <?= htmlspecialchars($tutor['name']) ?><br>
            <strong>Email:</strong> <?= htmlspecialchars($tutor['email']) ?><br>
            <strong>Credentials:</strong><br> <?= nl2br(htmlspecialchars($tutor['credentials'])) ?><br>
            <a href="admin.php?approve=<?= $tutor['id'] ?>">Approve</a> |
            <a href="admin.php?deny=<?= $tutor['id'] ?>">Deny</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>