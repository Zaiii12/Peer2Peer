<?php 

include 'Scripts/dbconnect.php';
$db = new Database();
$conn = $db->conn;

class processes {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create_user($username,$pass) {
        if($this->check_username($username)) {
            Echo "Username already exists, Please choose another one.";
            return;
        }
        $hashed = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("Call create_user(?,?)");
            if ($stmt === false) {
                die("Error occured within the statements" . $this->conn->error);
            }
            $stmt->bind_param("ss", $username, $hashed);
            $stmt->execute();
            $stmt->close();

            $user_id = $this->get_user_id($username);
            return [$user_id,$hashed];
    }

    public function create_tutor($first_name, $last_name, $gender, $username, $email_address, $pass, $tphoto, $cphoto) {
        [$user_id,$hashed] = $this->create_user($username, $pass);
        if (!$user_id) {
            die("User creation failed. No user found.");
        }
        
        $stmt = $this->conn->prepare("CALL create_tutor(?,?,?,?,?,?,?,?,?)");
        if ($stmt === false) {
            die("Error occurred within the statements: " . $this->conn->error);
        }

        $stmt->bind_param("issssssss", $user_id, $first_name, $last_name, $gender, $username, $email_address, $hashed, $tphoto, $cphoto);
        $stmt->execute();
        if ($stmt->error) {
            die("Error during execution: " . $stmt->error);
        }
            $stmt->close();
    }
    
    
    public function create_student($sphoto, $sr_code, $first_name, $last_name, $gender, $username, $email_address, $pass) {
        [$user_id,$hashed] = $this->create_user($username, $pass); 
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
    }
    
        private function check_username($username) {
            $result = 0;
            $check_username ="SELECT COUNT(*) From users WHERE username = ?";
            $check = $this->conn->prepare($check_username);
            $check->bind_param('s',$username);
            $check->execute();
            $check->bind_result($result);
            $check->fetch();
            $check->close();                   
    
            return $result > 0;
        }

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
            }

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
        }

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
        }

        public function get_user_id($username) {
            $user_id = null;
            $query = "SELECT user_id FROM users WHERE username = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();
        
            return $user_id;
        }
        
        public function hashed($pass) {
            return password_hash($pass, PASSWORD_DEFAULT);
        }

        public function login($username, $pass) {
            $stmt = $this->conn->prepare("
                SELECT u.user_id, u.pass, t.tutor_id, t.is_verified AS tutor_verified, s.is_verified AS student_verified
                FROM users u
                LEFT JOIN tutors t ON u.user_id = t.user_id
                LEFT JOIN students s ON u.user_id = s.user_id
                WHERE u.username = ?
            ");
        
            if ($stmt === false) {
                die("Error preparing SQL statement: " . $this->conn->error);
            }
        
            $stmt->bind_param("s", $username);  
            $stmt->execute();
            $stmt->store_result();
        
            if ($stmt->num_rows > 0) {
                $user_id = null;
                $hashed = 'null';
                $tutor_id = null;
                $tutor_verified = null;
                $student_verified = null;
        
                $stmt->bind_result($user_id, $hashed, $tutor_id, $tutor_verified, $student_verified);
                $stmt->fetch();
        
                if (password_verify($pass, $hashed)) {
                    if ($tutor_id !== null && $tutor_verified === 'Approved') {
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['role'] = 'tutor';
                        header("Location: HomepageT.php");
                    } elseif ($tutor_id === null && $student_verified === 'Approved') {
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['role'] = 'student';
                        header("Location: HomepageS.php");
                    } else {
                        echo "Your account is not approved. Please contact the administrator.";
                    }
                    exit;
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "Username not found.";
            }
        
            $stmt->close();
        }
        
        
        function checkLogin() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        
            if (!isset($_SESSION['user_id'])) {
                header("Location: login_page.php");
                exit;
            }
        }
        
        
        
}

?>
 