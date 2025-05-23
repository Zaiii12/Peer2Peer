<?php
session_start();
include 'Scripts/functions.php';
$process = new processes($conn);
$process->checklogin();

// Count students
$students = "SELECT COUNT(*) as student_count FROM students";
$result_students = $conn->query($students);
$studentCount = ($result_students && $row = $result_students->fetch_assoc()) ? $row['student_count'] : 0;

// Count tutors
$student_tutors = "SELECT COUNT(*) as tutor_count FROM tutors";
$result_tutors = $conn->query($student_tutors);
$tutorCount = ($result_tutors && $row = $result_tutors->fetch_assoc()) ? $row['tutor_count'] : 0;

// Count pending student requests
$pendingStudents = $conn->query("SELECT COUNT(*) as count FROM students WHERE is_verified = 'pending'");
$studentRequests = $pendingStudents->fetch_assoc()['count'] ?? 0;

// Count pending tutor requests
$pendingTutors = $conn->query("SELECT COUNT(*) as count FROM tutors WHERE is_verified = 'pending'");
$tutorRequests = $pendingTutors->fetch_assoc()['count'] ?? 0;

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
//For status of students
if (isset($_GET['approve']) && isset($_SESSION['admin_id'])) {
    $id = $_GET['approve'];
    $pdo->prepare("UPDATE students SET is_verified = 'approved' WHERE id = ?")->execute([$id]);
    header("Location: admin.php");
    exit;
}

if (isset($_GET['deny']) && isset($_SESSION['admin_id'])) {
    $id = $_GET['deny'];
    $pdo->prepare("UPDATE students SET is_verified = 'denied' WHERE id = ?")->execute([$id]);
    header("Location: admin.php");
    exit;
}
//For status of tutors
if (isset($_GET['approve']) && isset($_SESSION['admin_id'])) {
    $id = $_GET['approve'];
    $pdo->prepare("UPDATE tutors SET is_verified = 'approved' WHERE id = ?")->execute([$id]);
    header("Location: admin.php");
    exit;
}

if (isset($_GET['deny']) && isset($_SESSION['admin_id'])) {
    $id = $_GET['deny'];
    $pdo->prepare("UPDATE tutors SET is_verified = 'denied' WHERE id = ?")->execute([$id]);
    header("Location: admin.php");
    exit;
}
?>

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

    .card {
      border-radius: 5px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card p {
      font-size: 14px;
    }

    .card h4 {
      font-size: 22px;
      font-weight: 500;
    }

    .card ul {
      font-size: 14px;
    }

    .btn-outline-primary, .btn-outline-success, .btn-outline-dark, .btn-outline-info {
      margin-bottom: 10px;
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
            <h2><?php echo $studentRequests; ?></h2>
            <p class="mb-0">Sign Up Request - Student</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="../peer2peer/request_tutor.php" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2><?php echo $tutorRequests; ?></h2>
            <p class="mb-0">Sign Up Request - Tutor</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="#" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2><?php echo $studentCount; ?></h2>
            <p class="mb-0">All Students</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="#" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2><?php echo $tutorCount; ?></h2>
            <p class="mb-0">All Tutors</p>
          </div>
        </a>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card p-4">
          <h4 class="mb-3">Welcome, Admin!</h4>
          <p>Use this dashboard to monitor tutor and student activity, manage pending accounts, and maintain the system efficiently.</p>
          <ul>
            <li>Approve/Deny tutor and student registrations</li>
            <li>View all registered users</li>
            <li>Update subjects or platform info</li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card p-4">
          <h4 class="mb-3">Quick Actions</h4>
          <div class="d-grid gap-2">
            <a href="request_student.php" class="btn btn-outline-primary">Manage Student Requests</a>
            <a href="request_tutor.php" class="btn btn-outline-success">Manage Tutor Requests</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>
