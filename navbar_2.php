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
        <img src="https://via.placeholder.com/40" alt="Profile" class="profile-pic">
        <span class="fw-medium">sample06</span>
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a></li>
      </ul>
    </div>
    <button class="logout-btn" onclick="window.location.href='login_page.php'">LOGOUT</button>
  </div>

  <!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Username</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
                <label for="usernameInput" class="form-label">Username:</label>
                <input type="text" class="form-control mb-3" id="usernameInput" placeholder="Enter new username">
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
  </div>
  
  

  <!-- Change Password Modal -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Username</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
                <label for="currentPasswordInput" class="form-label">Current Password:</label>
                <input type="password" class="form-control mb-3" id="currentPasswordInput" placeholder="Enter your current password">

                <label for="newPasswordInput" class="form-label">New Password:</label>
                <input type="password" class="form-control mb-3" id="newPasswordInput" placeholder="Enter your new password">

                <label for="confirmPasswordInput" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control mb-3" id="confirmPasswordInput" placeholder="Confirm your new password">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
  </div>

  <!-- Bootstrap Bundle JS (includes dropdown & modal) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
