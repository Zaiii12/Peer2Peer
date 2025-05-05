<!DOCTYPE html>
<html lang="en">
<head>

  <?php
  include 'Scripts/functions.php';
  $process = new processes($conn);
  $process->checklogin();
  ?>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TutorLinkUp | Home</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  width: 100%;
  height: 100%;
  font-family: 'Poppins', sans-serif;
  overflow-x: hidden;
}

.navbar {
      padding: 1rem 2rem;
    }
    .navbar-brand img {
      height: 40px;
      margin-right: 10px;
    }
    .navbar-nav {
      gap: 2rem;
    }
    .navbar-nav .nav-link {

      color: #000;
    }
    .navbar-nav .nav-link:hover {
      color: #AF0009; 
    }

/* Main Wrapper Full Width */
.main-wrapper {
  width: 100%;
  max-width: 100%;
  margin: 0 auto;
}

/* Home Section */
.home-section {
  position: relative;
  width: 100%;
  height: 723px;
  overflow: hidden;
}

.home-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.home-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
  z-index: 1;
}

.home-text-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  color: #fff;
  text-align: center;
  width: 80%;
  max-width: 600px;
}

.home-title {
  font-family: 'Oswald', sans-serif;
  font-weight: 700;
  font-size: 64px;
  margin-bottom: 20px;
}

.home-subtitle {
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
  font-size: 24px;
  margin-bottom: 50px; /* Increased margin to add space between the subtitle and button */
}

.btn-red {
  background-color: #FF0000;
  color: #FFFFFF;
  width: 200px; /* Fixed width for the button as requested */
  height: 50px; /* Fixed height as requested */
  border-radius: 10px; /* Corner radius as requested */
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 18px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  text-decoration: none;
  border: none;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  margin-left: auto; /* Centers the button horizontally */
  margin-right: auto; /* Centers the button horizontally */
  transition: background-color 0.3s, color 0.3s;
}

.btn-red:hover {
  background-color: #d62828;
  color: #000000; /* Text becomes black on hover as requested */
}

/* About Section */
#about {
  background-color: #E0E0E0;
  padding: 50px 20px;
  text-align: center;
}

.section-title {
  font-family: 'Oswald', sans-serif;
  font-size: 40px;
  font-weight: bold;
  color: #FF0000; /* Color as requested */
  margin-bottom: 20px;
  text-transform: uppercase;
}

.poppins-regular {
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
  font-size: 16px;
  line-height: 1.6;
  max-width: 1100px;
  margin: 0 auto 30px; /* Added more space before the button */
}

.btn-read-more {
  background-color: #FF0000;
  color: #FFFFFF;
  width: 120px; /* Width as requested */
  height: 40px; /* Height as requested */
  border-radius: 5px; /* Corner radius as requested */
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 14px; /* Font size updated to 14px as requested */
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  border: none;
  margin: 0 auto;
  transition: background-color 0.3s, color 0.3s;
}

.btn-read-more:hover {
  background-color: #d62828;
  color: #000000; /* Text becomes black on hover as requested */
}

/* Subjects Section Styling */
#subjects {
  padding: 60px 20px;
  background-color: #f8f9fa;
}

/* Subject Card Styling */
.subject-card {
  width: 350px;
  height: 350px;
  background-color: #ffffff;
  border: 1px solid #000000;
  border-radius: 20px;
  padding: 20px;
  overflow: hidden;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Drop shadow */
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  font-family: 'Poppins', sans-serif;
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* Changed from center to space-between */
  align-items: center;
  text-align: center;
  margin: 10px;
}

.subject-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 14px 24px rgba(0, 0, 0, 0.2); /* Slightly stronger on hover */
}

.subject-icon {
  width: 100px;
  height: 100px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 30px; /* Added top margin */
  margin-bottom: 10px; /* Reduced bottom margin */
}

.icon-image {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

/* Subject Title */
.subject-card h5 {
  font-size: 16px;
  font-weight: 700; 
  color: #e63946;
  text-transform: uppercase;
  margin-bottom: 10px;
  margin-top: auto; 
}

/* Subject Description */
.subject-card p {
  font-size: 14px;
  font-weight: 400;
  color: #333333;
  padding: 0 10px;
  margin-top: auto;
  margin-bottom: 40px; /* Added bottom margin to push text up from bottom */
}

.subject-icon {
  margin-top: 30px;
  margin-bottom: 20px;
}

/* ========== VISION, MISSION, CORE VALUES SECTION ========== */
#vmv {
  background-color: #E0E0E0;
  padding: 60px 20px;
}

.section-title {
  font-size: 32px;
  font-weight: 700;
  color: #d32f2f;
  margin-bottom: 20px;
}

.poppins-regular {
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
  color: #333;
  font-size: 16px;
  line-height: 1.7;
  margin-bottom: 10px;
}


/* Responsive Tweaks */
@media (max-width: 991px) {
  .subject-card {
    width: 100%;
    height: auto;
    min-height: 300px;
  }

  .section-title {
    font-size: 32px;
  }
  
  .home-title {
    font-size: 48px;
  }
  
  .home-subtitle {
    font-size: 20px;
  }
}

.footer {
      background-color: #fff;
      padding: 2rem 1rem 1rem;
      border-top: 1px solid #000;
      font-family: 'Segoe UI', sans-serif;
    }

    .footer .footer-logo {
      font-size: 1.5rem;
      font-weight: bold;
      color: #e53935;
    }

    .footer .footer-subtitle {
      font-size: 1rem;
      margin-top: 0.5rem;
      color: #000;
    }

    .footer .footer-link {
      color: #000;
      text-decoration: none;
    }

    .footer .footer-link:hover {
      text-decoration: underline;
    }

    .footer .social-icons i {
      font-size: 1.5rem;
      margin-right: 0.75rem;
      color: #000;
    }

    .footer-bottom {
      border-top: 1px solid #000;
      margin-top: 1rem;
      padding-top: 0.75rem;
      font-size: 0.9rem;
      color: #000;
      display: flex;
      justify-content: space-between;
    }

    .footer .fa-phone,
    .footer .fa-envelope {
      margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
      .footer-bottom {
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        text-align: center;
      }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="img/logo.png" alt="TutorLinkUp Logo">
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#HomepageT.php">HOME</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">ABOUT US</a></li>
        <li class="nav-item"><a class="nav-link" href="#subjects">SUBJECTS</a></li>
        <li class="nav-item"><a class="nav-link" href="developers.php">DEVELOPERS</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">LOG OUT</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="main-wrapper">

    <!-- Home Section -->
    <section class="home-section d-flex align-items-center justify-content-center text-center" id="home">
  <img src="bsu-lipa.jpg" alt="Header Background" class="home-image">
  <div class="home-overlay"></div>
  <div class="home-text-container container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <h1 class="home-title">Link Up, Level Up!</h1>
        <p class="home-subtitle">Find your tutor, fuel your future.</p>
        <a href="tutor_dashboard.php" class="btn btn-red">Get Started</a>
      </div>
    </div>
  </div>
</section>
    

    <!-- About Section -->
    <section id="about" class="text-center">
      <div class="container">
        <h2 class="section-title">ABOUT US</h2>
        <p class="mb-4 poppins-regular">
          TutorLinkUp is a platform that connects Information Technology students with volunteer tutors. It focuses on providing academic support
          in major IT subjects, offering personalized tutoring to help students enhance their knowledge. The platform promotes a collaborative
          and respectful learning environment, where tutors share their expertise to support students' academic success.
        </p>
        <a href="about_us.php" class="btn btn-read-more poppins-semi-bold">Read More</a>
      </div>
    </section>

    <!-- Subjects Section -->
    <section id="subjects" class="py-5 bg-light text-center">
      <div class="container">
        <h2 class="section-title">SUBJECTS</h2>
        <div class="row g-4 justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex justify-content-center">
            <div class="subject-card">
              <div class="subject-icon">
                <img src="../peer2peer
                /img/s1.png" alt="Computer Icon" class="icon-image">
              </div>
              <h5>INTRODUCTION TO COMPUTING</h5>
              <p>Basic computer concepts, including hardware, software, and solving simple problems.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex justify-content-center">
            <div class="subject-card">
              <div class="subject-icon">
                <img src="../peer2peer
                /img/s2.png" alt="Programming Icon" class="icon-image">
              </div>
              <h5>COMPUTER PROGRAMMING</h5>
              <p>Creating instructions that a computer can execute using languages like Python, Java, C++.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex justify-content-center">
            <div class="subject-card">
              <div class="subject-icon">
                <img src="../peer2peer
                /img/s3.png" alt="Data Structures Icon" class="icon-image">
              </div>
              <h5>DATA STRUCTURES AND ALGORITHMS</h5>
              <p>Organizing and solving complex problems efficiently in computing.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex justify-content-center">
            <div class="subject-card">
              <div class="subject-icon">
                <img src="../peer2peer
                /img/s4.png" alt="Advanced Programming Icon" class="icon-image">
              </div>
              <h5>ADVANCED COMPUTER PROGRAMMING</h5>
              <p>Complex coding, software development techniques, and advanced programming concepts.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex justify-content-center">
            <div class="subject-card">
              <div class="subject-icon">
                <img src="../peer2peer
                /img/s5.png" alt="Database Icon" class="icon-image">
              </div>
              <h5>DATABASE MANAGEMENT SYSTEM</h5>
              <p>Managing, organizing, and retrieving data using database software systems.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex justify-content-center">
            <div class="subject-card">
              <div class="subject-icon">
                <img src="../peer2peer/img/s6.png" alt="OOP Icon" class="icon-image">
              </div>
              <h5>OBJECT - ORIENTED PROGRAMMING</h5>
              <p>Programming that uses objects to create modular, reusable code.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- Vision, Mission, Core Values Section -->
<section id="vmv" class="text-center py-5">
  <div class="container">
    <h2 class="section-title">VISION</h2>
    <p class="mb-4 poppins-regular">
      A leading digital platform that empowers students by connecting them with trusted, subject-specific tutors who foster academic growth and personal success.
    </p>

    <h2 class="section-title">MISSION</h2>
    <p class="mb-4 poppins-regular">
      TutorLinkUp is dedicated to helping students thrive by providing a user-friendly, secure, and accessible space to connect with expert tutors across a wide range of subjects.
      We aim to personalize learning, bridge educational gaps, and cultivate a supportive environment that inspires confidence and achievement in every learner.
    </p>

    <h2 class="section-title">CORE VALUES</h2>
    <p class="mb-1 poppins-regular"><strong>Empowerment</strong></p>
    <p class="mb-1 poppins-regular"><strong>Commitment</strong></p>
    <p class="mb-1 poppins-regular"><strong>Trust</strong></p>
    <p class="mb-1 poppins-regular"><strong>Accessibility</strong></p>
    <p class="mb-1 poppins-regular"><strong>Excellence</strong></p>
    <p class="mb-4 poppins-regular"><strong>Collaboration</strong></p>
  </div>
</section>

<!-- Footer Section -->
<footer class="footer container-fluid">
  <div class="row text-center text-md-start">
    <div class="col-md-3 mb-4">
      <div class="footer-logo d-flex align-items-center">
        <img src="img/logo.png" alt="TutorLinkUp Logo" style="height: 40px; margin-right: 10px;">
      </div>
      <div class="footer-subtitle">Link Up, Level Up</div>
    </div>
    <div class="col-md-3 mb-4">
      <a href="#" class="footer-link d-block">Home</a>
      <a href="#" class="footer-link d-block">About</a>
      <a href="#" class="footer-link d-block">Developers</a>
    </div>
    <div class="col-md-3 mb-4">
      <h6>Social Media</h6>
      <div class="social-icons mt-2">
        <i class="fab fa-facebook"></i>
        <i class="fab fa-instagram"></i>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <h6>Connect With Us</h6>
      <div class="mt-2">
        <i class="fas fa-phone"></i> (123) 456-7890<br/>
        <i class="fas fa-envelope mt-2"></i> tutorlinkup@gmail.com
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div>
      <i class="far fa-copyright"></i>
      2025 All Rights Reserved.
    </div>
    <div>
      Developed by Group 3
    </div>
  </div>
</footer>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
