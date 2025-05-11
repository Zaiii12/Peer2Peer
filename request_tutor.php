<?php
include 'Scripts/functions.php';

$db = new Database();
$conn = $db->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tutor_id = $_POST['tutor_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $conn->query("UPDATE tutors SET is_verified = 'Approved' WHERE tutor_id = '$tutor_id'");
    } elseif ($action === 'reject') {
        $conn->query("UPDATE tutors SET is_verified = 'Denied' WHERE tutor_id = '$tutor_id'");
    }
}

// Fetch pending tutors
$query = "SELECT tutor_id, first_name, last_name, gender, email_address 
          FROM tutors t
          JOIN users u ON t.user_id = u.user_id
          WHERE t.is_verified = 'Pending'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tutor Sign-Up Request</title>
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
  </style>
</head>
<body>

<div class="container-custom mx-auto px-3">
  <nav aria-label="breadcrumb" class="mt-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tutor Sign-up Request</li>
    </ol>
  </nav>

  <div class="card card-custom">
    <div class="mb-3">
      <h3 class="section-title">Tutor Sign-Up Request</h3>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
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
                <td><?= $row['tutor_id'] ?></td>
                <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['gender']) ?></td>
                <td><?= htmlspecialchars($row['email_address']) ?></td>
                <td>
                  <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="tutor_id" value="<?= $row['tutor_id'] ?>">
                    <button type="submit" name="action" value="approve" class="btn btn-sm btn-approve">Approve</button>
                  </form>
                  <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="tutor_id" value="<?= $row['tutor_id'] ?>">
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
