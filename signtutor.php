<?php
include 'Scripts/dbconnect.php';
$db = new Database();
$conn = $db->conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['username'], $_POST['email_address'], $_POST['pass'])) {

        $first_name = $conn->real_escape_string($_POST["first_name"]);
        $last_name = $conn->real_escape_string($_POST["last_name"]);
        $gender = $conn->real_escape_string($_POST["gender"]);
        $username = $conn->real_escape_string($_POST["username"]);
        $email_address = $conn->real_escape_string($_POST["email_address"]);
        $pass = $_POST["pass"];

        $photo = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            if (!is_dir("Tphoto")) mkdir("Tphoto"); 
            $photo = 'Tphoto/' . basename($_FILES['photo']['name']);
            move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
        } else {
            echo "Error: Photo is required!";
            exit;
        }

        $photo_credentials = null;
        if (isset($_FILES['photo_credentials']) && $_FILES['photo_credentials']['error'] == 0) {
            if (!is_dir("Credentials")) mkdir("Credentials");
            $photo_credentials = 'Credentials/' . basename($_FILES['photo_credentials']['name']);
            move_uploaded_file($_FILES['photo_credentials']['tmp_name'], $photo_credentials);
        } else {
            echo "Error: Credentials photo is required!";
            exit;
        }

        $stmt = $conn->prepare("CALL create_tutor(?, ?, ?, ?, ?, ?, ?, ?, @result_message)");
        if ($stmt === false) {
            die("Error preparing SQL: " . $conn->error);
        }

        $stmt->bind_param("ssssssss", $first_name, $last_name, $gender, $username, $email_address, $pass, $photo, $photo_credentials);

        if ($stmt->execute()) {
            $result = $conn->query("SELECT @result_message AS result_message");
            $row = $result->fetch_assoc();
            echo $row['result_message'];
        } else {
            echo "Error executing procedure: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill all required fields.";
    }
}
?>
