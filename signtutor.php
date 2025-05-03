<?php
include 'Scripts/functions.php';
$db = new Database();
$conn = $db->conn;

$process = new processes($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];
    $email_address = $_POST["email_address"];
    $pass = $_POST["pass"];

    $tphoto = $process->upload_tphoto("tphoto", $username);
    $cphoto = $process->upload_cphoto("cphoto", $username);

    $process->create_tutor($first_name, $last_name, $gender, $username, $email_address, $pass, $tphoto, $cphoto);

    echo "Tutor successfully created.";
}
?>
