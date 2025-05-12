<?php
include 'Scripts/functions.php';

$process = new processes($conn);  
$process->checkLogin();

$user_id = $process->get_user_id_from_session(); 

$tutor_id = $process->get_tutor_id_from_user($user_id, $conn); 

if ($tutor_id === 0) {
    echo "No tutor found for the given user ID.";
    exit;
}

$query = "SELECT * FROM tutor_profiles WHERE tutor_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $tutor_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $subject = $_POST["subject"];
    $language = $_POST["language"];
    $description = $_POST["description"];
    $image = $_FILES["image"]; 


    $process->update_tutor_profile($tutor_id, $name, $subject, $language, $description, $image);
    
    echo "Profile updated successfully!";
}