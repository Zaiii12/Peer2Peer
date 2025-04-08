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

        // This is just for the username, So it doesn't have any duplicates since the table wants it to be unique. \\
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
            if (isset($_FILES['Sphoto']) && $_FILES['photo']['error'] == 0) {
                $photo = 'uploads/' . $_FILES['photo']['name'];
                move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
            }

            $stmt2 = $conn->prepare("INSERT INTO users (username, pass) VALUES (?, ?)");
            if ($stmt2 === false) {
                die("Error preparing the SQL statement: " . $conn->error);
            }
            $stmt2->bind_param("ss", $username, $hashedPassword);

            if ($stmt2->execute()) {
                $user_id = $conn->insert_id; 

                echo "User has been signed up!<br>";

                $stmt = $conn->prepare("INSERT INTO students (photo, sr_code, first_name, last_name, gender, username, email_address, pass, user_id) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt === false) {
                    die("Error preparing the SQL statement: " . $conn->error);
                }

                $stmt->bind_param("ssssssssi", $photo, $sr_code, $first_name, $last_name, $gender, $username, $email_address, $hashedPassword, $user_id);

                if ($stmt->execute()) {
                    echo "Student has been signed up!";
                } else {
                    echo "Error inserting into students: " . $stmt->error;
                }
            } else {
                echo "Error inserting into users: " . $stmt2->error;
            }

            $stmt->close();
            $stmt2->close();
        }
    } else {
        echo "Please fill all required fields.";
    }
}
?>
