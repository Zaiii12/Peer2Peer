<!DOCTYPE html>
<html lang="en">

<?php
    include 'Scripts/dbconnect.php';
    $db = new Database(); 
    $conn = $db->conn; 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="overlay">
        <div class="loginForm"> 
            <h1>LOGIN</h1>
            <form action="login.php" method="POST">
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
                <button type="submit" class="btn btn-danger loginButton">LOGIN</button> 
                <p class="signUpLink">Don't have an account? <a href="../Peer2Peer/chooseUser.php">Sign Up</a></p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>