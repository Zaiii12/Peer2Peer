<?php
include 'Scripts/functions.php';

$db = new Database();
$conn = $db->conn;

$process = new processes($conn);

$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sr_code = $_POST["sr_code"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];
    $email_address = $_POST["email_address"];
    $pass = $_POST["pass"];

    $sphoto = $process->upload_sphoto("sphoto", $username);
    $process->create_student($sphoto, $sr_code, $first_name, $last_name, $gender, $username, $email_address, $pass);

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tutor Registration</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    .swal2-popup {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body>

<?php if ($success): ?>
<script>
  Swal.fire({
    title: 'Success!',
    text: 'Student successfully created, Pending Approval',
    icon: 'success',
    confirmButtonText: 'OK'
  }).then(() => {
    window.location.href = 'HomepageS.php'; 
  });
</script>
<?php endif; ?>

</body>
</html>



