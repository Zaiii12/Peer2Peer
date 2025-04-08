<? php
 include 'Scripts/dbconnect.php'
 $db = new Database();
 $conn = $db-> conn;

 if ($_SERVER["REQUEST_METHOD"]== "POST")

    if(isset($POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['username'], $_POST['email_address'], $_POST['pass'],$_POST["is_verified"])) {

        $first_name = $conn->real_escape_string($_POST["first_name"]);
        $last_name = $conn->real_escape_string($_POST["last_name"]);
        $gender = $conn->real_escape_string($_POST["gender"]);
        $email_address = $conn->real_escape_string($_POST['email_address']);
        $pass = $conn->real_escape_string($_POST['pass']);
    }

    //DI PA AKO TAPOS WAG NIYO GALAWIN TO!!!//
?>