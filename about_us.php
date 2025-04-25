<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us - TutorLinkUp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    /* ========== NAVIGATION BAR ========== */
    .custom-header {
      width: 100%; 
      height: 120px;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      z-index: 1000;
      margin-bottom: 0;
      padding-bottom: 0%;
    }

    .header-content {
      width: 1440px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 50px;
    }

    .logo-area {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo-img {
      width: 266px;
      height: 64px;
      object-fit: contain;
    }

    .brand-name {
      color: #d32f2f;
      font-weight: bold;
      font-size: 24px;
    }

    .nav-menu {
      display: flex;
      gap: 60px;
    }

    .nav-item {
      font-size: 20px;
      font-weight: 300;
      color: #000;
      text-decoration: none;
      transition: 0.3s;
    }

    .nav-item:hover,
    .nav-item:focus {
      color: #d32f2f;
      text-decoration: underline;
    }

    /* ========== ABOUT SECTION ========== */
    .about-section {
      min-height: 100vh;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
    }

    .about-container {
      background-color: #fff;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      display: flex;
      width: 100%;
      height: calc(100% - 120px);
      max-width: 100%;
      overflow: hidden;
      flex-wrap: wrap;
    }

    .about-image {
      flex: 1;
      background-color: #1a1a1a;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .about-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .about-content {
      flex: 1;
      padding: 60px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: center;
    }

    .about-title {
      color: red;
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: center;
    }

    .about-text p {
      margin-bottom: 20px;
      line-height: 1.6;
      color: #333;
    }

    .about-text strong {
      color: #000;
    }

    @media (max-width: 992px) {
      .about-container {
        flex-direction: column;
      }

      .about-image,
      .about-content {
        flex: none;
        width: 100%;
        height: 50vh;
      }

      .about-content {
        padding: 40px 20px;
        height: auto;
      }

      .about-title {
        font-size: 2.5rem;
      }
    }
  </style>
</head>
<body>

  <!-- Header / Navigation -->
  <header class="custom-header">
    <div class="header-content">
      <div class="logo-area">
        <img src="logo.jpg" alt="TutorLinkUp Logo" class="logo-img">
      </div>
      <nav class="nav-menu">
        <a href="#" class="nav-item">HOME</a>
        <a href="#" class="nav-item">ABOUT US</a>
        <a href="#" class="nav-item">SUBJECTS</a>
        <a href="#" class="nav-item">DEVELOPERS</a>
        <a href="#" class="nav-item login">LOGIN</a>
      </nav>
    </div>
  </header>

  <!-- About Section -->
  <div class="about-section">
    <div class="about-container">
      <div class="about-image">
        <img src="img/au.png" alt="About Us Image" />
      </div>
      <div class="about-content">
        <h1 class="about-title">ABOUT US</h1>
        <div class="about-text">
          <p><strong>TutorLinkUp</strong> is a dynamic and innovative platform designed to connect students in the Information Technology program with skilled volunteer tutors.</p>
          <p>Whether you're struggling with a complex concept or aiming to enhance your knowledge, TutorLinkUp provides easy access to experienced tutors who are passionate about helping students succeed.</p>
          <p>Our platform focuses on major IT subjects, providing personalized academic support in a collaborative, respectful, and professional environment. As a student, you can find a tutor who fits your learning style, and as a tutor, you can make a meaningful impact by sharing your expertise and supporting the next generation of IT professionals.</p>
          <p>At TutorLinkUp, we believe in the power of peer learning and community. Let’s work together to achieve your academic goals and build a stronger foundation for your future in Information Technology.</p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
