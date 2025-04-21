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

        $stmt = $this->conn->prepare("Call create_user(?,?)");
            if ($stmt === false) {
                die("Error occured within the statements" . $this->conn->error);
            }
            $stmt->bind_param("ss", $username, $pass);
            $stmt->execute();
            $stmt->close();

            $user_id = $this->get_user_id($username);
            return $user_id;
    }

    public function create_tutor($first_name, $last_name, $gender, $username, $email_address, $pass, $tphoto, $cphoto) {
        $user_id = $this->create_user($username, $pass);
        if (!$user_id) {
            die("User creation failed. No user found.");
        }
        
        $stmt = $this->conn->prepare("CALL create_tutor(?,?,?,?,?,?,?,?,?)");
        if ($stmt === false) {
            die("Error occurred within the statements: " . $this->conn->error);
        }

        $stmt->bind_param("issssssss", $user_id, $first_name, $last_name, $gender, $username, $email_address, $pass, $tphoto, $cphoto);
        $stmt->execute();
        if ($stmt->error) {
            die("Error during execution: " . $stmt->error);
        }
            $stmt->close();
    }
    
    
    public function create_student($sphoto, $sr_code, $first_name, $last_name, $gender, $username, $email_address, $pass) {
        $user_id = $this->create_user($username, $pass);  // Get the user_id after user creation
        if (!$user_id) {
            die("User creation failed. No user_id found.");
        }
            $stmt = $this->conn->prepare("CALL create_student(?,?,?,?,?,?,?,?,?)");
        
        if ($stmt === false) {
            die("Error occurred within the statements: " . $this->conn->error);
        }
    
        $stmt->bind_param("issssssss", $user_id, $sphoto, $sr_code, $first_name, $last_name, $gender, $username, $email_address, $pass);
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
            $destination =  'Sphoto/' . $photo_name;

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
            $destination = 'Tphoto/' . $photo_name;

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
            $destination = 'Cphoto/' . $photo_name;

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
        
        
    }  

?>
 