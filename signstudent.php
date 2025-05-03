<?php
include 'Scripts/functions.php';
$db = new Database();
$conn = $db->conn;

$process = new processes($conn);

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

    echo "Student successfully created.";
}
?>

