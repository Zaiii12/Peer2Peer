<?php
include 'Scripts/functions.php';
$process = new processes($conn);
$process->checklogin();

$selected_subject = $_GET['subject'] ?? '';

$tutors = $selected_subject !== ''
    ? $process->get_tutor_profiles_by_subject($conn, $selected_subject)

    : $process->get_all_tutor_profiles($conn);

$subjects = $process->get_all_subjects($conn); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard | TutorLinkUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
      margin-top: 30px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .card img {
      height: 80px;
      width: 80px;
      background-color: #ccc;
      border-radius: 8px;
      object-fit: cover;
    }
    .card {
      border: 1px solid #ddd;
      transition: 0.3s;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
<?php include 'navbar_2.php'; ?>

<div class="container mt-5">
  <div class="row mb-4 welcome">
    <div class="col-12">
      <h2>Welcome to TutorLinkUp!</h2>
      <p>We're glad to have you here! ...</p>
    </div>
  </div>

  <div class="row mb-4 find_tutor">
    <div class="col-md-8 col-12">
        <form method="GET" action="">
            <label for="subject" class="mb-2">Find a Tutor:</label>
            <select name="subject" id="subject" class="form-select" onchange="this.form.submit()">
                <option value="" <?php if ($selected_subject == "") echo "selected"; ?>>Select a Subject</option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?php echo htmlspecialchars($subject); ?>" <?php if ($selected_subject == $subject) echo "selected"; ?>>
                        <?php echo htmlspecialchars($subject); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
  </div>

  <h3 class="mb-4"><?= $selected_subject ? "Tutors for " . ucwords($selected_subject) : "All Available Tutors" ?>:</h3>

  <div class="row g-4">
    <?php if (empty($tutors)): ?>
      <div class="col-12">
        <div class="alert alert-info text-center p-4">
          <i class="bi bi-info-circle-fill me-2"></i>
          No available tutors <?= $selected_subject ? "for " . ucwords($selected_subject) : "" ?> at this time.
        </div>
      </div>
    <?php else: ?>
      <?php foreach ($tutors as $tutor): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card p-3 h-100">
            <div class="d-flex align-items-start gap-3">
              <img src="<?= htmlspecialchars($tutor['image']) ?>" alt="Profile of <?= htmlspecialchars($tutor['name']) ?>">
              <div>
                <div class="card-title"><?= htmlspecialchars($tutor['name']) ?></div>
                <div><i class="bi bi-book"></i> <?= htmlspecialchars($tutor['subject']) ?></div>
                <div><i class="bi bi-translate"></i> <?= htmlspecialchars($tutor['language']) ?></div>
              </div>
            </div>
            <div class="mt-3">
              <p><?= htmlspecialchars($tutor['description']) ?></p>
              <a href="tutor_preview.php?id=<?= $tutor['tutor_id'] ?>" class="read-more">View Profile <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
