<?php
require_once 'Scripts/functions.php';


$process = new processes($conn);
$process->checklogin();


// $user_id = $_SESSION['user_id'] ?? 0;
// echo $user_id;   // FOR DEBUGGING DO NOT TOUCH 

$query = "SELECT tutor_id FROM tutors WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($tutor_id);
$stmt->fetch();
$stmt->close();

$query = "SELECT * FROM tutor_profiles WHERE tutor_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $tutor_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Tutor Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .form-container {
      max-width: 700px;
      margin: 50px auto;
      background: white;
      padding: 30px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      border-radius: 8px;
    }
  </style>
</head>
<body>
<div class="container form-container">
  <h3 class="mb-4">Update Your Profile</h3>
  <form action="update_profile.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($profile['name'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
      <label for="subject" class="form-label">Subject</label>
      <input type="text" name="subject" id="subject" class="form-control" value="<?= htmlspecialchars($profile['subject'] ?? '') ?>">
    </div>
    <div class="mb-3">
      <label for="language" class="form-label">Language(s)</label>
      <input type="text" name="language" id="language" class="form-control" value="<?= htmlspecialchars($profile['language'] ?? '') ?>">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">About Me</label>
      <textarea name="description" id="description" class="form-control" rows="4"><?= htmlspecialchars($profile['description'] ?? '') ?></textarea>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Profile Image</label><br>
      <?php if (!empty($profile['image'])): ?>
        <img src="<?= htmlspecialchars($profile['image']) ?>" width="100" height="100" class="mb-2" alt="Profile Image"><br>
      <?php endif; ?>
      <input type="file" name="image" id="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
  </form>
</div>
</body>
</html>
