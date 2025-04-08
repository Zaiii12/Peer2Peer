<!DOCTYPE html>
<html lang="en">

<?php
    include 'Scripts/dbconnect.php';
    $db = new Database(); 
    $conn = $db->conn; 
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="overlay d-flex align-items-center justify-content-center">
        <div class="chooseUser text-center">
            <h1 class="title">I am a</h1>
            <div class="row justify-content-center g-3 buttonContainer">
                <div class="col-12 col-sm-5 d-grid">
                    <a href="../TutorLinkUp/signUp_page1.html" class="btn btn-danger tutorButton">Tutor</a>
                </div>
                <div class="col-12 col-sm-5 d-grid">
                    <a href="../TutorLinkUp/signUp_page2.html" class="btn btn-danger studentButton">Student</a>
            </div>
            <p class="loginLink">Already have an account? <a href="../Peer2Peer/login_page.php">Login</a></p>
         </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
