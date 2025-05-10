<?php
include 'Scripts/functions.php';
$db = new Database();
$conn = $db->conn;
session_start();

$status = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    $process = new Processes($conn);
    $status = $process->login($username, $pass); // returns: tutor_success, student_success, pending, invalid_password, not_found
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    .swal2-popup {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body>

<?php if ($status === 'tutor_success'): ?>
<script>
Swal.fire({
  title: 'Success!',
  text: 'Tutor login successful!',
  icon: 'success',
  confirmButtonText: 'OK'
}).then(() => {
  window.location.href = 'HomepageT.php';
});
</script>

<?php elseif ($status === 'student_success'): ?>
<script>
Swal.fire({
  title: 'Success!',
  text: 'Student login successful!',
  icon: 'success',
  confirmButtonText: 'OK'
}).then(() => {
  window.location.href = 'HomepageS.php';
});
</script>

<?php elseif ($status === 'pending'): ?>
<script>
Swal.fire({
  title: 'Notice',
  text: 'Your account is not approved yet.',
  icon: 'info',
  confirmButtonText: 'OK'
  }).then(() => {
  window.location.href = 'login_page.php';
});
</script>

<?php elseif ($status === 'invalid_password'): ?>
<script>
Swal.fire({
  title: 'Error',
  text: 'Invalid password.',
  icon: 'error',
  confirmButtonText: 'OK'
    }).then(() => {
  window.location.href = 'login_page.php';
});
</script>

<?php elseif ($status === 'not_found'): ?>
<script>
Swal.fire({
  title: 'Error',
  text: 'Username not found.',
  icon: 'error',
  confirmButtonText: 'OK'
    }).then(() => {
  window.location.href = 'login_page.php';
});
</script>
<?php endif; ?>

</body>
</html>



