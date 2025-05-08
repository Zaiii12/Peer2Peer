<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  // Include only one connection file
  include 'Scripts/functions.php';
  $process = new processes($conn);
  $process->checklogin();
  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard | TutorLinkUp</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
 
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .welcome {
      background-color: #FF0000; /* Kept the original red color as requested */
      color: white;
      padding: 20px;
      text-align: left;
      border-radius: 5px; /* Changed to match your original design */
      margin-top: 30px; /* Increased top margin for more spacing */
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .welcome h2 {
      font-weight: bold;
    }

    .find_tutor label {
      padding: 0;
      font-size: 20px;
      font-weight: 500;
    }

    .find_tutor select {
      height: 40px;
      border-radius: 5px;
      width: 100%;
    }

    .card {
      border: 1px solid #ddd;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      height: 100%;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .card img {
      height: 80px;
      width: 80px;
      background-color: #ccc;
      border-radius: 8px; /* Box shape as requested instead of circle */
      object-fit: cover;
    }
    
    .card-title {
      font-weight: bold;
      color: #333;
    }
    
    .icon-text {
      display: flex;
      align-items: center;
      gap: 5px;
      margin: 4px 0;
      color: #555;
    }
    
    .read-more {
      font-weight: 500;
      text-decoration: none;
      color: #0d6efd;
      display: inline-block;
      margin-top: 5px;
    }
    
    .read-more:hover {
      text-decoration: underline;
    }
    
    .tutor-title {
      font-size: 24px;
      font-weight: 600;
      color: #333;
      margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
      .welcome {
        margin-top: 10px;
        padding: 15px;
      }
      
      .welcome h2 {
        font-size: 1.5rem;
      }
      
      .find_tutor label {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>
<?php include 'navbar_3.php'; ?>

<?php
    
    // Get selected subject (if any)
    $selected_subject = "";
    if(isset($_GET['subject'])) {
        // Sanitize input
        $selected_subject = htmlspecialchars($_GET['subject'], ENT_QUOTES, 'UTF-8');
    }
?>

  <div class="container mt-5">
    <div class="row mb-4 welcome">
      <div class="col-12">
        <h2>Welcome to TutorLinkUp!</h2>
        <p>We're glad to have you here! TutorLinkUp is your academic companion, connecting Information Technology students with dedicated volunteer tutors. Whether you need help understanding a tough topic or want to strengthen your knowledge in a major IT subject, we're here to support your learning journey.
        <br><br>
        Let's grow, learn, and succeed—together.</p>
      </div>
    </div>

    <div class="row mb-4 find_tutor">
        <div class="col-md-8 col-12">
            <form method="GET" action="">
                <label for="subject" class="mb-2">Find a Tutor:</label>
                <select name="subject" id="subject" class="form-select" onchange="this.form.submit()">
                    <option value="" <?php if($selected_subject == "") echo "selected"; ?>>Select a Subject</option>
                    <option value="introduction to computing" <?php if($selected_subject == "introduction to computing") echo "selected"; ?>>Introduction to Computing</option>
                    <option value="computer programming" <?php if($selected_subject == "computer programming") echo "selected"; ?>>Computer Programming</option>
                    <option value="data structures and algorithm" <?php if($selected_subject == "data structures and algorithm") echo "selected"; ?>>Data Structures and Algorithm</option>
                    <option value="advance computer programming" <?php if($selected_subject == "advance computer programming") echo "selected"; ?>>Advance Computer Programming</option>
                    <option value="database management system" <?php if($selected_subject == "database management system") echo "selected"; ?>>Database Management System</option>
                    <option value="object oriented programming" <?php if($selected_subject == "object oriented programming") echo "selected"; ?>>Object Oriented Programming</option>
                </select>
            </form>
        </div>
    </div>

    <?php
    // Display subject name in heading
    if($selected_subject != "") {
        echo '<h3 class="tutor-title">Tutors for ' . ucwords($selected_subject) . ':</h3>';
    } else {
        echo '<h3 class="tutor-title">All Available Tutors:</h3>';
    }
    ?>

    <div class="row g-4">
    <?php
    // This should eventually be replaced with a database query
    // For now, using the static data array
    $tutors = array(
      array(
        "name" => "Christine May Padua",
        "subject" => "computer programming",
        "language" => "Filipino, English",
        "desc" => "Christine is passionate about helping others understand core programming concepts.",
        "image" => "assets/images/default-profile.jpg", // Replace with actual image path
        "read_more_link" => "http://localhost/Peer2Peer/tutor_info.php"
      ),
      array(
        "name" => "John Doe",
        "subject" => "introduction to computing",
        "language" => "Filipino, English",
        "desc" => "John focuses on simplifying computing fundamentals for beginners.",
        "image" => "assets/images/default-profile.jpg", // Replace with actual image path
        "read_more_link" => "http://localhost/Peer2Peer/view_tutor.php?"
      ),
      array(
        "name" => "Jane Smith",
        "subject" => "database management system",
        "language" => "Filipino, English",
        "desc" => "Jane provides guidance on SQL and database concepts with hands-on examples.",
        "image" => "assets/images/default-profile.jpg", // Replace with actual image path
        "read_more_link" => "http://localhost/Peer2Peer/request_tutor.php#"
      )
    );
    
    $tutors_available = false;
    if($selected_subject != "") {
        foreach($tutors as $tutor) {
            if($tutor["subject"] == $selected_subject) {
                $tutors_available = true;
                break;
            }
        }
       
        // If no tutors found for the selected subject, display a message
        if(!$tutors_available) {
            echo '<div class="col-12">
                    <div class="alert alert-info text-center p-4">
                      <i class="bi bi-info-circle-fill me-2"></i>
                      No available tutors for ' . ucwords($selected_subject) . ' at this time.
                      <p class="mt-2 mb-0">Please check back later or select another subject.</p>
                    </div>
                  </div>';
        }
    }

    $count = 0;
    foreach($tutors as $tutor) {
      if($selected_subject != "" && $tutor["subject"] != $selected_subject) {
          continue;
      }
      
      $count++;
      echo '<div class="col-lg-4 col-md-6 mb-4">
          <div class="card p-3 h-100">
            <div class="d-flex align-items-start gap-3">
              <img src="' . $tutor["image"] . '" alt="Profile of ' . $tutor["name"] . '">
              <div>
                <div class="card-title">' . $tutor["name"] . '</div>
                <div class="icon-text"><i class="bi bi-book"></i> ' . ucwords($tutor["subject"]) . '</div>
                <div class="icon-text"><i class="bi bi-translate"></i> ' . $tutor["language"] . '</div>
              </div>
            </div>
            <div class="mt-3">
              <p class="mb-1">' . $tutor["desc"] . '</p>
              <a href="' . $tutor["read_more_link"] . '" class="read-more">View Profile <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>';
    }
    
    // If no tutors are displayed (all subjects selected but no data available)
    if($count == 0 && $selected_subject == "") {
        echo '<div class="col-12">
                <div class="alert alert-info text-center p-4">
                  <i class="bi bi-info-circle-fill me-2"></i>
                  No tutors are available at this time.
                  <p class="mt-2 mb-0">Please check back later.</p>
                </div>
              </div>';
    }
    ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
