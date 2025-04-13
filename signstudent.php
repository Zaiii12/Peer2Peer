<?php
include 'Scripts/dbconnect.php';
$db = new Database();
$conn = $db->conn;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['sr_code'], $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['username'], $_POST['email_address'], $_POST['pass'])) {

        $sr_code = $conn->real_escape_string($_POST["sr_code"]); 
        $first_name = $conn->real_escape_string($_POST["first_name"]);
        $last_name = $conn->real_escape_string($_POST["last_name"]);
        $gender = $conn->real_escape_string($_POST["gender"]);
        $username = $conn->real_escape_string($_POST["username"]);
        $email_address = $conn->real_escape_string($_POST["email_address"]);
        $pass = $_POST["pass"];

        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $checkUsernameQuery = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmtCheck = $conn->prepare($checkUsernameQuery);
        $stmtCheck->bind_param("s", $username);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($count > 0) {
            echo "Username already exists. Please choose a different username.";
        } else {
            $photo = null;  
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                if (!is_dir("uploads")) {
                    mkdir("uploads"); 
                }
                $photo = 'uploads/' . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photo); 
            }

            $stmtUser = $conn->prepare("INSERT INTO users (username, pass) VALUES (?, ?)");
            $stmtUser->bind_param("ss", $username, $hashedPassword);
            if ($stmtUser->execute()) {
                $user_id = $conn->insert_id;

                $stmt = $conn->prepare("CALL create_student(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssi", $photo, $sr_code, $first_name, $last_name, $gender, $username, $email_address, $hashedPassword, $user_id);

                if ($stmt->execute()) {
                    echo "Student has been signed up successfully!";
                } else {
                    echo "Error executing procedure: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error inserting into users: " . $stmtUser->error;
            }
            $stmtUser->close();
        }
    } else {
        echo "Please fill all required fields.";
    }
}
?>
