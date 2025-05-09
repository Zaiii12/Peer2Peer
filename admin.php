
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .card-box {
      background-color: #FF0000;
      color: white;
      padding: 20px;
      text-align: left;
      border-radius: 5px;
    }

    .card-box h2{
      font-size: 40px;
    }

    .card-box p{
      font-size: 14px;
    }

    .graph-placeholder {
      height: 250px;
      background-color: #d9d9d9;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 500;
    }
  </style>
</head>
<body>
<?php
    include 'navbar_2.php'; 
?>

  <div class="container mt-5">
    <div class="row g-4">
      <div class="col-12 col-sm-6 col-md-3">
        <a href="../peer2peer/request_student.php" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2>0</h2>
            <p class="mb-0">Sign Up Request - Student</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="../peer2peer/request_tutor.php" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2>0</h2>
            <p class="mb-0">Sign Up Request - Tutor</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="#" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2>0</h2>
            <p class="mb-0">All Students</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="#" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2>0</h2>
            <p class="mb-0">All Tutors</p>
          </div>
        </a>
      </div>
    </div>

    <div class="row mt-5 g-4">
      <div class="col-md-6">
        <div class="graph-placeholder">
          Graph for No. of Tutors
        </div>
      </div>
      <div class="col-md-6">
        <div class="graph-placeholder">
          Graph for No. of Students
        </div>
      </div>
    </div>
  </div>

  <?php
session_start();
require_once 'Scripts/dbconnect.php';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count students
$students = "SELECT COUNT(*) as student_count FROM students";
$result_students = $conn->query($students);
$studentCount = ($result_students && $row = $result_students->fetch_assoc()) ? $row['student_count'] : 0;

// Count tutors
$student_tutors = "SELECT COUNT(*) as tutor_count FROM student_tutors";
$result_tutors = $conn->query($student_tutors);
$tutorCount = ($result_tutors && $row = $result_tutors->fetch_assoc()) ? $row['tutor_count'] : 0;

$conn->close();

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

    <?php
        $userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        echo "<p>Total users signed up: $userCount</p>";
    ?>
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
