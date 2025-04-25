<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Developers</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="dstyles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <style>
    body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
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

.title h2 {
    font-weight: bold;
}

.title span {
    color: red;
}

.card {
    border: 1px solid #ccc;
    border-radius: 10px;
    height: 100%;
}

.card-img-top {
    height: 250px;
    object-fit: cover;
}

.card-title {
    font-weight: bold;
    color: red;
    margin-bottom: 0.5rem;
    text-align: left;
}


.card-text {
    font-size: 14px;
    margin-bottom: 0.3rem;
    text-align: left;
  }

.icons {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
    padding-left: 10px;
    padding-bottom: 10px;
    color: red;
}

.icons i {
    font-size: 18px;
    cursor: pointer;
    color: red;
    transition: 0.3s;
    margin-right: 10px;
}

.icons i:hover {
    transform: scale(1.1);
    opacity: 0.8;
}

.developer-card {
    margin-bottom: 30px;
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

  <div class="container py-5">
    <div class="title text-center mb-5">
      <h2><span class="title">TutorLinkUp</span> Developers</h2>
    </div>

    <div class="row g-4">

      <div class="col-lg-3 col-md-6">
        <div class="card h-100 text-center p-3">
          <img src="img/d1.png" class="card-img-top" alt="Christine">
          <div class="card-body">
            <h5 class="card-title">Christine May Padua</h5>
            <p class="card-text">UI/UX Designer</p>
            <p class="card-text">Front-End Developer</p>
          </div>
          <div class="icons">
            <a href="https://www.facebook.com/christinemay.padua.3/" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=christinemenor864@gmail.com" target="_blank">
                <i class="bi bi-envelope-fill"></i>
            </a>

          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100 text-center p-3">
          <img src="img/d2.png" class="card-img-top" alt="Jan">
          <div class="card-body">
            <h5 class="card-title">Jan Nole Matres</h5>
            <p class="card-text">Back-End Developer</p>
            <p class="card-text">&nbsp;</p>
          </div>
          <div class="icons">
            <a href="https://www.facebook.com/christinemay.padua.3/" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=christinemenor864@gmail.com" target="_blank">
                <i class="bi bi-envelope-fill"></i>
            </a>

          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100 text-center p-3">
          <img src="img/d3.png" class="card-img-top" alt="Jimae">
          <div class="card-body">
            <h5 class="card-title">Jimae Zabdiel Austria</h5>
            <p class="card-text">UI/UX Designer</p>
            <p class="card-text">Front-End Developer</p>
          </div>
          <div class="icons">
            <a href="https://www.facebook.com/share/16GTSiSRsA/?mibextid=wwXIfr" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=austriajimaezabdiel@gmail.com" target="_blank">
                <i class="bi bi-envelope-fill"></i>
            </a>

          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100 text-center p-3">
          <img src="img/d4.png" class="card-img-top" alt="Mark">
          <div class="card-body">
            <h5 class="card-title">Mark Anthony Bunsay</h5>
            <p class="card-text">Back-End Developer</p>
            <p class="card-text">&nbsp;</p>
          </div>
          <div class="icons">
            <a href="https://www.facebook.com/christinemay.padua.3/" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=christinemenor864@gmail.com" target="_blank">
                <i class="bi bi-envelope-fill"></i>
            </a>

          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100 text-center p-3">
          <img src="img/d5.png" class="card-img-top" alt="Gezelle">
          <div class="card-body">
            <h5 class="card-title">Gezelle Franz Maranan</h5>
            <p class="card-text">Front-End Developer</p>
            <p class="card-text">Back-End Support</p>
          </div>
          <div class="icons">
            <a href="https://www.facebook.com/christinemay.padua.3/" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=christinemenor864@gmail.com" target="_blank">
                <i class="bi bi-envelope-fill"></i>
            </a>

          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100 text-center p-3">
          <img src="img/d6.png" class="card-img-top" alt="Ace">
          <div class="card-body">
            <h5 class="card-title">Ace Russel De Silva</h5>
            <p class="card-text">Front-End Developer</p>
            <p class="card-text">Back-End Support</p>
          </div>
          <div class="icons">
            <a href="https://www.facebook.com/christinemay.padua.3/" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=christinemenor864@gmail.com" target="_blank">
                <i class="bi bi-envelope-fill"></i>
            </a>

          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100 text-center p-3">
          <img src="img/d7.png" class="card-img-top" alt="Klyzza">
          <div class="card-body">
            <h5 class="card-title">Klyzza Mae Medrazzo</h5>
            <p class="card-text">Front-End Developer</p>
            <p class="card-text">&nbsp;</p>
          </div>
          <div class="icons">
            <a href="https://www.facebook.com/share/1FKRyoHRYj/" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=klyzzamae@gmail.com" target="_blank">
                <i class="bi bi-envelope-fill"></i>
            </a>

          </div>
        </div>
      </div>


      <div class="col-lg-3 col-md-6">
        <div class="card h-100 text-center p-3">
          <img src="img/d8.png" class="card-img-top" alt="Khing">
          <div class="card-body">
            <h5 class="card-title">Khing Patrick Rudio</h5>
            <p class="card-text">Front-End Developer</p>
            <p class="card-text">&nbsp;</p>
          </div>
          <div class="icons">
            <a href="https://www.facebook.com/profile.php?id=100093371951051&mibextid=wwXIfr&mibextid=wwXIfr" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=khiingruudio@gmail.com" target="_blank">
                <i class="bi bi-envelope-fill"></i>
            </a>

          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>