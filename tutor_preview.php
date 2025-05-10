<?php
require_once 'Scripts/functions.php';
$process = new processes($conn);
$process->checklogin();

$tutor_id = $_GET['id'] ?? null;
$tutor = null;

if ($tutor_id) {
    $tutor = $process->get_tutor_profile_by_id($conn, $tutor_id);
}

if (!$tutor) {
    echo "<div class='alert alert-danger text-center mt-5'>Tutor not found.</div>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Tutor Info</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .profile-picture {
      width: 150px;
      height: 150px;
      background-color: #ccc;
      border-radius: 5px;
      object-fit: cover;
    }
    .facebook { color: #1877F2; }
    .telegram { color: #0088cc; }
    .name {
      color: red;
      font-weight: bold;
      font-size: 32px;
    }
    .card-custom {
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      border: none;
      width: 200px;
    }
    .about-me, .credentials {
      margin-top: 30px;
    }
    .button {
      background-color: red;
      height: 40px;
      width: 50px;
      color: white;
      text-align: center;
      border-radius: 5px;
    }
  </style>
</head>
<body>
<?php include 'navbar_2.php'; ?>

<div class="container mt-5">

  <!-- Profile Info -->
  <div class="row mt-4">
    <div class="col-md-8 d-flex">
      <img class="profile-picture me-4" src="<?= htmlspecialchars($tutor['image']) ?>" alt="Tutor Photo">

      <div>
        <div class="name"><?= htmlspecialchars($tutor['name']) ?></div>
        <p><i class="bi bi-briefcase me-2"></i>Experience: 3 Years of Programming</p>
        <p><i class="bi bi-book"></i> <?= htmlspecialchars($tutor['subject']) ?></p>
        <p><i class="bi bi-translate me-2"></i><?= htmlspecialchars($tutor['language']) ?></p>
      </div>
    </div>

    <!-- Message Me -->
    <div class="col-md-4">
      <div class="card card-custom p-3 text-center">
        <strong class="text-danger">Message me!</strong>
        <div class="d-flex align-items-center justify-content-center">
          <i class="bi bi-facebook fs-2 mx-2 facebook"></i>
          <img src="img/gmail.png" alt="Gmail" width="32" height="25" class="mx-2 align-icon">
          <i class="bi bi-telegram fs-2 mx-2 telegram"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- About Me -->
  <div class="about-me">
    <h5><strong>About Me</strong></h5>
    <p><?= htmlspecialchars($tutor['description']) ?></p>
  </div>

</div>

</body>
</html>
