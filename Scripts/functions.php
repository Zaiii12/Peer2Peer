<?php 

include 'Scripts/dbconnect.php';
$db = new Database();
$conn = $db->conn;

class processes {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create_tutor($first_name,$last_name,$gender,$username,$email_address,$pass,$photo,$photo_credentials) {
        $stmt = $this->conn->prepare("Call create_tutor(?,?,?,?,?,?,?,?, @result_message)");
        if ($stmt === false) {
            die("Error" . $this->conn->error);
        }

        $stmt->bind_param("ssssssss",$first_name,$last_name,$gender,$username,$email_address,$pass,$photo,$photo_credentials);
    }


    public function __construct($conn) {
        $this->conn = $conn;
    }
        public function create_student($sr_code,$first_name,$last_name,$gender,$username ,$email_address,$pass); 
         = $this->conn->prepare("Call create_student(?,?,?,?,?,?,?, @result_message)");


    {
    
        
    public function
    }

}




?>