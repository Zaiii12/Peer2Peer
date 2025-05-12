<?php 

include 'Scripts/dbconnect.php';
$db = new Database();
$conn = $db->conn;

class processes {

    private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        } // Gets the connection to the DB. 

        public function create_user($username, $pass) {
            $stmt = $this->conn->prepare("CALL check_username_exists(?, @exists_flag)");
            if ($stmt === false) {
                die("Error occurred within the statement: " . $this->conn->error);
            }
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->close();

            $result = $this->conn->query("SELECT @exists_flag");
            $row = $result->fetch_assoc();
            $exists_flag = $row['@exists_flag'];


            if ($exists_flag == 1) {
                echo "Username already exists, Please choose another one.";
                return;
            }


            $hashed = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("CALL create_user(?, ?)");
            if ($stmt === false) {
                die("Error occurred within the statement: " . $this->conn->error);
            }
            $stmt->bind_param("ss", $username, $hashed);
            $stmt->execute();
            $stmt->close();

            $user_id = $this->get_user_id($username);
            
            return [$user_id, $hashed];
        } // Creates user and checks if there's an existing username within the DB

        public function create_tutor($first_name, $last_name, $gender, $username, $email_address, $pass, $tphoto, $cphoto) {
            [$user_id, $hashed] = $this->create_user($username, $pass);
            if (!$user_id) {
                die("User creation failed. No user found.");
            }

            $stmt = $this->conn->prepare("CALL create_tutor(?,?,?,?,?,?,?,?,?)");
            if ($stmt === false) {
                die("Error occurred within the statements: " . $this->conn->error);
            }

            // Bind parameters for the stored procedure
            $stmt->bind_param("issssssss", $user_id, $first_name, $last_name, $gender, $username, $email_address, $hashed, $tphoto, $cphoto);
            $stmt->execute();
            if ($stmt->error) {
                die("Error during execution: " . $stmt->error);
            }
            $stmt->close();

            // Retrieve the tutor_id associated with the created user
            $tutor_id = null;
            $stmt = $this->conn->prepare("SELECT tutor_id FROM tutors WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($tutor_id);
            $stmt->fetch();
            $stmt->close();

            // Insert the tutor profile if tutor_id is found
            if ($tutor_id) {
                $stmt = $this->conn->prepare("INSERT INTO tutor_profiles (tutor_id) VALUES (?)");
                $stmt->bind_param("i", $tutor_id);
                $stmt->execute();
                $stmt->close();
            } else {
                die("Failed to retrieve tutor_id.");
            }
        } // Creates tutor but also inserts the tutor_id into the tutor_profiles.

        public function create_student($sphoto, $sr_code, $first_name, $last_name, $gender, $username, $email_address, $pass) {
            [$user_id, $hashed] = $this->create_user($username, $pass); 
            if (!$user_id) {
                die("User creation failed. No user_id found.");
            }

            $stmt = $this->conn->prepare("CALL create_student(?,?,?,?,?,?,?,?,?)");
            if ($stmt === false) {
                die("Error occurred within the statements: " . $this->conn->error);
            }

            $stmt->bind_param("issssssss", $user_id, $sphoto, $sr_code, $first_name, $last_name, $gender, $username, $email_address, $hashed);
            $stmt->execute();
            $stmt->close();


        } // Just creates the student user
    
        public function check_username($username) {
            $exists_flag = 0;

            $stmt = $this->conn->prepare("CALL check_username_exists(?, @exists_flag)");
            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->close();

            $result = $this->conn->query("SELECT @exists_flag AS exists_flag");
            if ($result) {
                $row = $result->fetch_assoc();
                return (bool)$row['exists_flag'];
            }

            return false;
        } // Checks for existing usernames within the Database.

        public function upload_sphoto($input_name,$username) {
            $photo_name = $username . '_' . basename($_FILES[$input_name]['name']);
            $tmp_name = $_FILES[$input_name]['tmp_name'];
            $destination =  'uploads/Sphoto/' . $photo_name;

            if (move_uploaded_file($tmp_name,$destination)) {
                return $destination;
                }
                else {
                    return "Failed to move upload.";
                }
        } // Uploads Student Photo for Verification.

        public function upload_tphoto($tphoto, $username){
            $photo_name = $username . '_' . basename($_FILES[$tphoto]['name']);
            $tmp_name = $_FILES[$tphoto]['tmp_name'];
            $destination = 'uploads/Tphoto/' . $photo_name;

            if(move_uploaded_file($tmp_name, $destination)) {
                return $destination; 
            }
            else {
                return "Failed to move upload.";
            }
        } // Uploads Tutor Photo for Verification.

        public function upload_cphoto($cphoto, $username) {
            $photo_name = $username . '_' . basename($_FILES[$cphoto]['name']);
            $tmp_name = $_FILES[$cphoto]['tmp_name'];
            $destination = 'uploads/Cphoto/' . $photo_name;

            if (move_uploaded_file($tmp_name, $destination)) {
                return $destination;
            }
            else {
                return "Failed to move upload.";
            }
        } // Uploads Credential

        public function get_user_id($username) {
            $user_id = null;

            $stmt = $this->conn->prepare("CALL get_user_id_by_username(?, @user_id)");
            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->close();

            $result = $this->conn->query("SELECT @user_id AS user_id");
            if ($result && $row = $result->fetch_assoc()) {
                return $row['user_id'];
            }

            return null;
        } // for use of the create_user function so that it correctly gets the user_id from the Table.
        
        public function hashed($pass) {
            return password_hash($pass, PASSWORD_DEFAULT);
        } 

            public function login($username, $pass) {
                
            $adminStmt = $this->conn->prepare("SELECT admin_id, pass FROM admin WHERE username = ?");
                if (!$adminStmt) {
                die("Error preparing admin SQL: " . $this->conn->error);
                }

                $adminStmt->bind_param("s", $username);
                $adminStmt->execute();
                    $adminStmt->store_result();

                if ($adminStmt->num_rows > 0) {
                $admin_id = null;
                $admin_pass = '';

                $adminStmt->bind_result($admin_id, $admin_pass);
                $adminStmt->fetch();

                if ($pass === $admin_pass) { 
                    $_SESSION['admin_id'] = $admin_id;
                    $_SESSION['role'] = 'admin';
                    $adminStmt->close();
                    return 'admin_success';
                } else {
                    $adminStmt->close();
                    return 'invalid_password';
                }
            }
                $adminStmt->close();


            // If not admin, check users table (tutor or student)
            $stmt = $this->conn->prepare("
                SELECT u.user_id, u.pass,
                    t.tutor_id, t.is_verified AS tutor_verified,
                    s.is_verified AS student_verified
                FROM users u
                LEFT JOIN tutors t ON u.user_id = t.user_id
                LEFT JOIN students s ON u.user_id = s.user_id
                WHERE u.username = ?
            ");

            if (!$stmt) {
                die("Error preparing user SQL: " . $this->conn->error);
            }

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $user_id = null;
                $hashed = '';
                $tutor_id = null;
                $tutor_verified = null;
                $student_verified = null;

                $stmt->bind_result($user_id, $hashed, $tutor_id, $tutor_verified, $student_verified);
                $stmt->fetch();

                if (password_verify($pass, $hashed)) {
                    $_SESSION['user_id'] = $user_id;

                    if ($tutor_id !== null && $tutor_verified === 'Approved') {
                        $_SESSION['role'] = 'tutor';
                        $stmt->close();
                        return 'tutor_success';
                    }

                    if ($tutor_id === null && $student_verified === 'Approved') {
                        $_SESSION['role'] = 'student';
                        $stmt->close();
                        return 'student_success';
                    }

                    $stmt->close();
                    return 'pending';
                } else {
                    $stmt->close();
                    return 'invalid_password';
                }
            }

            $stmt->close();
            return 'not_found';
        } 
            
        function checkLogin() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
                header("Location: login_page.php");
                exit;
            }

            return $_SESSION['admin_id'] ?? $_SESSION['user_id'];
        } // Checks login and instantiates the session start.

        public function get_user_id_from_session() {
            return $_SESSION['user_id'] ?? 0; 
        } // Just gets user ID for the session.
        
        public function get_tutor_id_from_user($user_id, $conn) {
            $stmt = $conn->prepare("CALL get_tutor_id_from_user(?, @tutor_id)");
            if ($stmt === false) {
                die("Error preparing statement: " . $conn->error);
            }
            
            $stmt->bind_param("i", $user_id);
            
            $stmt->execute();
            $stmt->close();

            $result = $conn->query("SELECT @tutor_id AS tutor_id");
            if ($result === false) {
                die("Error executing query to get tutor_id: " . $conn->error);
            }


            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                return $row['tutor_id'] ?? 0; 
            } else {
                return 0;
            }
        }

        
        public function update_tutor_profile($tutor_id, $name, $subject, $language, $description, $image) {

            $query = "UPDATE tutor_profiles SET name = ?, subject = ?, language = ?, description = ?, image = ? WHERE tutor_id = ?";

            $existing_image = null;

            if (!empty($image['tmp_name'])) {

                $image_path = $this->upload_image($image, $tutor_id);
            } else {
                $stmt = $this->conn->prepare("SELECT image FROM tutor_profiles WHERE tutor_id = ?");
                $stmt->bind_param("i", $tutor_id);
                $stmt->execute();
                $stmt->bind_result($existing_image);
                $stmt->fetch();
                $stmt->close();
                
                $image_path = $existing_image ?: '';
            }

            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                die("Error preparing SQL statement: " . $this->conn->error);
            }


            $stmt->bind_param("sssssi", $name, $subject, $language, $description, $image_path, $tutor_id);

            $stmt->execute();

            if ($stmt->error) {
                die("Error during execution: " . $stmt->error);
            }

            $stmt->close();
            return true;
        } // Too many debugging to figure out this was not the one throwing errors .-.
             
        private function upload_image($image, $tutor_id) {

            $image_name = "tutor_" . $tutor_id . "_" . basename($image['name']);
            $destination = 'uploads/tutor_images/' . $image_name;
        
            if (move_uploaded_file($image['tmp_name'], $destination)) {
                return $destination;
            } else {
                return "assets/images/default-profile.jpg"; 
            }
        } // Upload images to Tutors.
        
        public function get_all_tutor_profiles($conn) {
                $stmt = $conn->prepare("CALL get_all_tutor_profiles()");
                $stmt->execute();
                $result = $stmt->get_result();

                $tutors = [];
                while ($row = $result->fetch_assoc()) {
                    $tutors[] = $row;
                }

                $stmt->close();
                return $tutors;
        } // Gets the entire tutor profile selects and tables.


        public function get_tutor_profiles_by_subject($conn, $subject) {
            $stmt = $conn->prepare("CALL get_tutor_profiles_by_subject(?)");
            $stmt->bind_param("s", $subject);
            $stmt->execute();
            $result = $stmt->get_result();

            $tutors = [];
            while ($row = $result->fetch_assoc()) {
                $tutors[] = $row;
            }

            $stmt->close();
            return $tutors;
        }  // Gets the entirety of tutors via subjects
        
        public function get_all_subjects($conn) {
            $stmt = $conn->prepare("CALL get_all_subjects()");
            $stmt->execute();
            $result = $stmt->get_result();

            $subjects = [];
            while ($row = $result->fetch_assoc()) {
                $subjects[] = $row['subject_name'];
            }

            $stmt->close();
            return $subjects;
        } // Just calls the subjects that are allowed.

        
        public function get_tutor_profile_by_id($conn, $id) {
            $stmt = $conn->prepare("CALL get_tutor_profile_by_id(?)");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $tutor = $result->fetch_assoc();
            $stmt->close();
            return $tutor;
        } // Specifically gets the tutor_id from the profiles to check the contents.

        public function get_user_by_id($conn, $user_id) {
            $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } // Simple select where it just gets the user id for use in checking.

}

?>
 