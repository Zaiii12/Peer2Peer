<?php
include 'Scripts/functions.php';

$db = new Database();
$conn = $db->conn;

// Handle approval/rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $conn->query("UPDATE students SET is_verified = 'Approved' WHERE student_id = '$student_id'");
    } elseif ($action === 'reject') {
        $conn->query("UPDATE students SET is_verified = 'Denied' WHERE student_id = '$student_id'");
    }
}

// Fetch pending students
$query = "SELECT student_id, sr_code, first_name, last_name, gender, email_address 
          FROM students s
          JOIN users u ON s.user_id = u.user_id
          WHERE s.is_verified = 'Pending'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Sign-Up Request</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .container-custom { max-width: 1350px; width: 100%; }
    .card-custom { border-radius: 10px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); padding: 20px; margin-top: 20px; }
    .table th, .table td { vertical-align: middle; text-align: center; }
    .table th { background-color: #f8f9fa; }
    .btn-approve { background-color: #2CF200; color: white; }
    .btn-reject { background-color: #FF0000; color: white; }
    .section-title { font-size: 40px; font-weight: 500; color: red; }
    .filter-input { width: 200px; }
  </style>
</head>
<body>

<div class="container-custom mx-auto px-3">
  <nav aria-label="breadcrumb" class="mt-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Student Sign-up Request</li>
    </ol>
  </nav>

  <div class="card card-custom">
    <div class="mb-3">
      <h3 class="section-title">Student Sign-Up Request</h3>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Sr–Code</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Email Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row['student_id'] ?></td>
                <td><?= htmlspecialchars($row['sr_code']) ?></td>
                <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['gender']) ?></td>
                <td><?= htmlspecialchars($row['email_address']) ?></td>
                <td>
                  <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="student_id" value="<?= $row['student_id'] ?>">
                    <button type="submit" name="action" value="approve" class="btn btn-sm btn-approve">Approve</button>
                  </form>
                  <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="student_id" value="<?= $row['student_id'] ?>">
                    <button type="submit" name="action" value="reject" class="btn btn-sm btn-reject">Reject</button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="6">No pending requests.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
