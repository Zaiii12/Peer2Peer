<?php
require_once 'Scripts/functions.php';
$process = new processes($conn);
$user_id = $_SESSION['user_id'] ?? null;
$profile_image = 'uploads\PLACEHOLDER\Placeholder.png'; // default fallback
$username = 'Guest';

if ($user_id) {
    $user_data = $process->get_user_by_id($conn, $user_id);
    if (!empty($user_data['image'])) {
        $profile_image = htmlspecialchars($user_data['image']);
    }
    if (!empty($user_data['username'])) {
        $username = htmlspecialchars($user_data['username']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Navbar Sample</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Poppins Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .navbar-custom {
      background-color: white;
      padding: 15px 30px;
      border-bottom: 1px solid #ccc;
    }

    .profile-pic {
      width: 50px;
      height: 50px;
      background-color: #d9d9d9;
      border-radius: 50%;
      object-fit: cover;
    }

    span {
      font-size: 14px;
    }

    .logout-btn {
      background-color: #FF0000;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 10px;
      transition: 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #AF0009;
    }

    .dropdown-toggle::after {
      display: none;
    }
  </style>
</head>
<body>

<!-- Custom Navbar -->
<div class="navbar-custom d-flex justify-content-between align-items-center">
  <div class="dropdown">
    <a class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="<?= $profile_image ?>" alt="Profile" class="profile-pic">
      <span class="fw-medium"><?= $username ?></span>
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="tutor_profile.php" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</a></li>
    </ul>
  </div>
  <button class="logout-btn" onclick="window.location.href='logout.php'">LOGOUT</button>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="editProfileModalLabel">Update Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="firstName" class="form-label">First Name:</label>
              <input type="text" class="form-control" id="firstName">
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Last Name:</label>
              <input type="text" class="form-control" id="lastName">
            </div>
            <div class="col-md-6">
              <label for="gender" class="form-label">Gender:</label>
              <select class="form-select" id="gender">
                <option selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
                <option value="Prefer not to say">Prefer not to say</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="srCode" class="form-label">Sr-Code:</label>
              <input type="text" class="form-control" id="srCode">
            </div>
            <div class="col-md-6">
              <label for="username" class="form-label">Username:</label>
              <input type="text" class="form-control" id="username">
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email Address:</label>
              <input type="email" class="form-control" id="email">
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle JS (includes dropdown & modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

