<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .welcome {
      background-color:rgb(255, 255, 255);
      color: black;
      padding: 20px;
      text-align: left;
      border-radius: 5px;
      border: 2px solid red;
    }

    .welcome h2{
        font-weight: bold;
        color: red;
    }

    .custom-btn {
  background-color: #ff0000 !important; /* Bright red */
  border-radius: 10px;
  font-size: 1rem;
  font-weight: 500;
}

  </style>
</head>
<body>
<?php
    include 'navbar_4.php'; 
?>
  <div class="container mt-5">
    <div class="row mb-5 welcome">
      <h2>Welcome to TutorLinkUp!</h2>
      <p>We’re glad to have you here! TutorLinkUp is your academic companion, connecting Information Technology students with dedicated volunteer tutors. Whether you need help understanding a tough topic or want to strengthen your knowledge in a major IT subject, we’re here to support your learning journey.
      <br>
      <br>Let’s grow, learn, and succeed—together.</p>
    </div>

    <button class="btn btn-danger custom-btn px-4 py-2 d-block mx-auto">
  My Tutor Information
</button>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
