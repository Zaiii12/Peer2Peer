<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .card-box {
      background-color: #FF0000;
      color: white;
      padding: 20px;
      text-align: left;
      border-radius: 5px;
    }

    .card-box h2{
      font-size: 40px;
    }

    .card-box p{
      font-size: 14px;
    }

    .graph-placeholder {
      height: 250px;
      background-color: #d9d9d9;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 500;
    }
  </style>
</head>
<body>
<?php
    include 'navbar_2.php'; 
?>

  <div class="container mt-5">
    <div class="row g-4">
      <div class="col-12 col-sm-6 col-md-3">
        <a href="../frontend/request_student.php" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2>0</h2>
            <p class="mb-0">Sign Up Request - Student</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="../frontend/request_tutor.php" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2>0</h2>
            <p class="mb-0">Sign Up Request - Tutor</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="#" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2>0</h2>
            <p class="mb-0">All Students</p>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <a href="#" class="text-decoration-none text-dark">
          <div class="card-box">
            <h2>0</h2>
            <p class="mb-0">All Tutors</p>
          </div>
        </a>
      </div>
    </div>

    <div class="row mt-5 g-4">
      <div class="col-md-6">
        <div class="graph-placeholder">
          Graph for No. of Tutors
        </div>
      </div>
      <div class="col-md-6">
        <div class="graph-placeholder">
          Graph for No. of Students
        </div>
      </div>
    </div>
  </div>

</body>
</html>
