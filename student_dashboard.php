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
      background-color: #FF0000;
      color: white;
      padding: 20px;
      text-align: left;
      border-radius: 5px;
    }

    .welcome h2{
        font-weight: bold;
    }

    .find_tutor label{
        padding: 0;
        font-size: 20px;
        font-weight: 500;
    }

    .find_tutor select{
        height: 40px;
        border-radius: 5px;
    }
    
    
    .card {
      border: 1px solid #333;
    }
    .card img {
      height: 80px;
      width: 80px;
      background-color: #ccc;
      border-radius: 8px;
    }
    .card-title {
      font-weight: bold;
    }
    .icon-text {
      display: flex;
      align-items: center;
      gap: 5px;
      margin: 4px 0;
    }
    .read-more {
      font-weight: 500;
      text-decoration: underline;
    }
    .tutor-title {
      font-size: 20px;
      font-weight: 500;
    
    }
  </style>
</head>
<body>
<?php
    include 'navbar_3.php'; 
?>
  <div class="container mt-5">
    <div class="row mb-5 welcome">
      <h2>Welcome to TutorLinkUp!</h2>
      <p>We’re glad to have you here! TutorLinkUp is your academic companion, connecting Information Technology students with dedicated volunteer tutors. Whether you need help understanding a tough topic or want to strengthen your knowledge in a major IT subject, we’re here to support your learning journey.
      <br>
      <br>Let’s grow, learn, and succeed—together.</p>
    </div>

    <div class="row mb-5 find_tutor">
        <div class="col-md-10">
            <label for="findTutor">Find a Tutor:</label> <br>
            <select name="findTutor" id="findTutor">
                <option value="" disabled selected>Select a Subject</option>
                <option value="introduction to computing">Introduction to Computing</option>
                <option value="computer programming">Computer Programming</option>
                <option value="data structures and algorithm">Data Structures and Algorithm</option>
                <option value="advance computer programming">Advance Computer Programming</option>
                <option value="database managemnt system">Database Management System</option>
                <option value="object oriented programming">Object Oriented Programming</option>
            </select>
        </div>
        
    </div>

    <p class="tutor-title">Tutors for (subject):</p>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="card p-3">
          <div class="d-flex align-items-start gap-3">
            <img src="#" alt="profile">
            <div>
              <div class="card-title">Christine May Padua</div>
              <div class="icon-text"><i class="bi bi-book"></i> Subject</div>
              <div class="icon-text"><i class="bi bi-translate"></i> Filipino, English</div>
            </div>
          </div>
          <div class="mt-3">
            <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            <a href="#" class="read-more">Read More</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3">
          <div class="d-flex align-items-start gap-3">
            <img src="#" alt="profile">
            <div>
              <div class="card-title">Christine May Padua</div>
              <div class="icon-text"><i class="bi bi-book"></i> Subject</div>
              <div class="icon-text"><i class="bi bi-translate"></i> Filipino, English</div>
            </div>
          </div>
          <div class="mt-3">
            <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            <a href="#" class="read-more">Read More</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3">
          <div class="d-flex align-items-start gap-3">
            <img src="#" alt="profile">
            <div>
              <div class="card-title">Christine May Padua</div>
              <div class="icon-text"><i class="bi bi-book"></i> Subject</div>
              <div class="icon-text"><i class="bi bi-translate"></i> Filipino, English</div>
            </div>
          </div>
          <div class="mt-3">
            <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            <a href="#" class="read-more">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
