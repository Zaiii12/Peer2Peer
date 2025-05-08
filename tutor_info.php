
<?php
// Start session to store user data
session_start();

// Database connection
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tutoring_system"; // Update with your database name

    try {
        // Create connection with mysqli
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if database exists, create if it doesn't
        $result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
        
        if ($result->num_rows == 0) {
            // Database doesn't exist, create it
            if ($conn->query("CREATE DATABASE $dbname")) {
                echo "<div class='alert alert-success'>Database created successfully</div>";
                
                // Create tables
                $conn->select_db($dbname);
                
                // Create tutors table
                $sql = "CREATE TABLE tutors (
                    id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(50) NOT NULL,
                    last_name VARCHAR(50) NOT NULL,
                    gender ENUM('Male', 'Female', 'Prefer not to say') NOT NULL,
                    username VARCHAR(50) NOT NULL UNIQUE,
                    email_address VARCHAR(255) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    tphoto VARCHAR(255) DEFAULT 'uploads/default-profile.jpg',
                    cphoto VARCHAR(255) DEFAULT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                $conn->query($sql);
                
                // Create subjects table
                $sql = "CREATE TABLE subjects (
                    id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    subject_name VARCHAR(100) NOT NULL UNIQUE,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                $conn->query($sql);
                
                // Create tutor_subjects table for many-to-many relationship
                $sql = "CREATE TABLE tutor_subjects (
                    id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    tutor_id INT(11) NOT NULL,
                    subject_id INT(11) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (tutor_id) REFERENCES tutors(id) ON DELETE CASCADE,
                    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
                    UNIQUE KEY tutor_subject_unique (tutor_id, subject_id)
                )";
                $conn->query($sql);
                
                // Insert sample data if this is first run
                $password_hash = password_hash('password123', PASSWORD_DEFAULT);
                $sql = "INSERT INTO tutors (first_name, last_name, gender, username, email_address, password) 
                        VALUES ('John', 'Doe', 'Male', 'johndoe', 'john@example.com', '$password_hash')";
                $conn->query($sql);
                
                $sql = "INSERT INTO subjects (subject_name) VALUES ('Mathematics'), ('Physics'), ('Chemistry'), ('Biology')";
                $conn->query($sql);
                
                $sql = "INSERT INTO tutor_subjects (tutor_id, subject_id) VALUES (1, 1), (1, 2)";
                $conn->query($sql);
                
                // Create sample user session
                $_SESSION['user_id'] = 1;
                $_SESSION['username'] = 'johndoe';
                $_SESSION['additional_info'] = [
                    'about' => 'I am an experienced tutor with a passion for teaching.',
                    'experience' => '5 years',
                    'language' => 'English, Spanish',
                    'gmail' => 'john.doe@gmail.com',
                    'telegram' => '@johndoe',
                    'facebook' => 'facebook.com/johndoe'
                ];
            } else {
                die("Error creating database: " . $conn->error);
            }
        }
        
        // Select the database
        $conn->select_db($dbname);
        return $conn;
        
    } catch (Exception $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // For development: Create a test user session if database was just created
    if (!isset($_SESSION['setup_complete'])) {
        // This will force database setup and sample data creation
        $conn = connectDB();
        $_SESSION['setup_complete'] = true;
    } else {
        // Redirect to login page if not logged in
        header("Location: login.php");
        exit;
    }
}

$tutor_id = $_SESSION['user_id'] ?? 1; // Default to 1 for demo purposes
$conn = connectDB();

// Initialize variables
$first_name = "";
$last_name = "";
$gender = "";
$username = "";
$email_address = "";
$tphoto = "uploads/default-profile.jpg";
$photo_credentials = "";

// Additional fields not in the database but in the form
$about = isset($_SESSION['additional_info']['about']) ? $_SESSION['additional_info']['about'] : '';
$experience = isset($_SESSION['additional_info']['experience']) ? $_SESSION['additional_info']['experience'] : '';
$language = isset($_SESSION['additional_info']['language']) ? $_SESSION['additional_info']['language'] : '';
$gmail = isset($_SESSION['additional_info']['gmail']) ? $_SESSION['additional_info']['gmail'] : '';
$telegram = isset($_SESSION['additional_info']['telegram']) ? $_SESSION['additional_info']['telegram'] : '';
$facebook = isset($_SESSION['additional_info']['facebook']) ? $_SESSION['additional_info']['facebook'] : '';

// Fetch tutor data from database
$query = "SELECT id, first_name, last_name, gender, username, email_address, tphoto, cphoto FROM tutors WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $tutor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $gender = $row['gender'];
    $username = $row['username'];
    $email_address = $row['email_address'];
    $tphoto = $row['tphoto'] ? $row['tphoto'] : 'uploads/default-profile.jpg';
    $photo_credentials = $row['cphoto'];
}
$stmt->close();

// Fetch subjects taught by tutor
$subjects = [];
$query = "SELECT s.subject_name 
          FROM subjects s 
          JOIN tutor_subjects ts ON s.id = ts.subject_id 
          WHERE ts.tutor_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $tutor_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $subjects[] = $row['subject_name'];
}
$stmt->close();

$subject = implode(", ", $subjects);

// Process form submission for edit info
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_info'])) {
    // Sanitize inputs
    $updated_first_name = htmlspecialchars($_POST['first_name']);
    $updated_last_name = htmlspecialchars($_POST['last_name']);
    $updated_gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : $gender;
    $updated_username = htmlspecialchars($_POST['username']);
    $updated_email = htmlspecialchars($_POST['email_address']);
    $updated_photo_credentials = isset($_POST['credentials']) ? htmlspecialchars($_POST['credentials']) : $photo_credentials;
    
    // Store additional info in session
    $_SESSION['additional_info']['about'] = htmlspecialchars($_POST['about']);
    $_SESSION['additional_info']['experience'] = htmlspecialchars($_POST['experience']);
    $_SESSION['additional_info']['language'] = htmlspecialchars($_POST['language']);
    $_SESSION['additional_info']['gmail'] = htmlspecialchars($_POST['gmail']);
    $_SESSION['additional_info']['telegram'] = htmlspecialchars($_POST['telegram']);
    $_SESSION['additional_info']['facebook'] = htmlspecialchars($_POST['facebook']);
    
    try {
        // Update tutor data directly in database
        $stmt = $conn->prepare("UPDATE tutors SET 
                            first_name = ?, 
                            last_name = ?, 
                            gender = ?, 
                            username = ?, 
                            email_address = ?, 
                            cphoto = ? 
                            WHERE id = ?");
        $stmt->bind_param("ssssssi", 
            $updated_first_name, 
            $updated_last_name, 
            $updated_gender, 
            $updated_username, 
            $updated_email,
            $updated_photo_credentials,
            $tutor_id
        );
        
        if ($stmt->execute()) {
            // Update successful
            $_SESSION['success_message'] = "Profile updated successfully!";
            $first_name = $updated_first_name;
            $last_name = $updated_last_name;
            $gender = $updated_gender;
            $username = $updated_username;
            $email_address = $updated_email;
            $photo_credentials = $updated_photo_credentials;
            
            // Refresh additional variables
            $about = $_SESSION['additional_info']['about'];
            $experience = $_SESSION['additional_info']['experience'];
            $language = $_SESSION['additional_info']['language'];
            $gmail = $_SESSION['additional_info']['gmail'];
            $telegram = $_SESSION['additional_info']['telegram'];
            $facebook = $_SESSION['additional_info']['facebook'];
        } else {
            $_SESSION['error_message'] = "Error updating profile: " . $stmt->error;
        }
        $stmt->close();
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Error updating profile: " . $e->getMessage();
    }
    
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Process profile picture upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_photo'])) {
    // Check if file was uploaded without errors
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['profile_pic']['name'];
        $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        // Validate file extension
        if (in_array($fileExt, $allowed)) {
            // Create uploads directory if it doesn't exist
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            
            // Generate unique filename
            $newFilename = 'profile_' . time() . '.' . $fileExt;
            $destination = 'uploads/' . $newFilename;
            
            // Move uploaded file
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination)) {
                // Update photo in database
                $stmt = $conn->prepare("UPDATE tutors SET tphoto = ? WHERE id = ?");
                $stmt->bind_param("si", $destination, $tutor_id);
                
                if ($stmt->execute()) {
                    $tphoto = $destination;
                    $_SESSION['success_message'] = "Profile photo updated successfully!";
                } else {
                    $_SESSION['error_message'] = "Error updating profile photo: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $_SESSION['error_message'] = "Error uploading file.";
            }
        } else {
            $_SESSION['error_message'] = "Invalid file type. Allowed: jpg, jpeg, png, gif";
        }
    } else {
        $_SESSION['error_message'] = "Error uploading file. Error code: " . $_FILES['profile_pic']['error'];
    }
    
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tutor Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      padding: 20px;
    }

    .profile-box {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 6px;
      padding: 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-top: 20px;
    }

    .profile-title {
      color: red;
      font-weight: 700;
      margin-bottom: 25px;
    }

    .profile-label {
      font-weight: 500;
    }

    .form-control[readonly] {
      background-color: #e6e6e6;
      border: none;
      box-shadow: none;
    }

    .change-photo-btn,
    .edit-btn,
    .save-btn {
      background-color: red;
      color: white;
      font-weight: 500;
      border: none;
      border-radius: 6px;
    }

    .edit-btn {
      float: right;
    }

    .profile-pic {
      width: 250px;
      height: 250px;
      aspect-ratio: 3/4;
      background-color: #ccc;
      border-radius: 6px;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .btn-spacing {
      margin-top: 10px;
    }
    
    .alert {
      margin-bottom: 20px;
    }
    
    /* Hidden by default, shown when edit button is clicked */
    .editable-form {
      display: none;
    }
  </style>
</head>
<body>

<div class="container">
  <!-- Display Messages -->
  <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  
  <?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="profile-box">
    <div class="d-flex justify-content-between align-items-start mb-4">
      <h2 class="profile-title">My Information</h2>
      <button class="btn edit-btn px-3 py-2" id="editInfoBtn">Edit Info</button>
    </div>

    <!-- Read-only View (Default) -->
    <div class="view-mode" id="viewMode">
      <div class="row">
        <!-- Left Column (Photo) -->
        <div class="col-md-3 d-flex flex-column align-items-center">
          <div class="profile-pic mb-3" id="profilePreview" style="background-image: url('<?php echo $tphoto; ?>')"></div>
          <button class="btn change-photo-btn px-3 py-2" data-bs-toggle="modal" data-bs-target="#changePhotoModal">Change Photo</button>
        </div>

        <!-- Right Column (Details) -->
        <div class="col-md-9">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="profile-label">Name:</label>
              <input type="text" class="form-control" readonly value="<?php echo $first_name . ' ' . $last_name; ?>">
            </div>
            <div class="col-md-6">
              <label class="profile-label">Subject:</label>
              <input type="text" class="form-control" readonly value="<?php echo $subject; ?>">
            </div>

            <div class="col-md-6">
              <label class="profile-label">Years of Experience in Tutoring:</label>
              <input type="text" class="form-control" readonly value="<?php echo $experience; ?>">
            </div>
            <div class="col-md-6">
              <label class="profile-label">Language:</label>
              <input type="text" class="form-control" readonly value="<?php echo $language; ?>">
            </div>

            <div class="col-md-6">
              <label class="profile-label">About Me:</label>
              <textarea class="form-control" rows="3" readonly><?php echo $about; ?></textarea>
            </div>
            <div class="col-md-6">
              <label class="profile-label">Credentials:</label>
              <input type="text" class="form-control" readonly value="<?php echo $photo_credentials; ?>">
            </div>

            <div class="col-md-6">
              <label class="profile-label">Gmail Link:</label>
              <input type="text" class="form-control" readonly value="<?php echo $gmail; ?>">
            </div>
            <div class="col-md-6">
              <label class="profile-label">Telegram Link:</label>
              <input type="text" class="form-control" readonly value="<?php echo $telegram; ?>">
            </div>

            <div class="col-md-6">
              <label class="profile-label">Facebook Link:</label>
              <input type="text" class="form-control" readonly value="<?php echo $facebook; ?>">
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Editable Form (Hidden by Default) -->
    <div class="editable-form" id="editMode">
      <form method="POST" id="updateForm">
        <div class="row">
          <!-- Left Column (Photo) -->
          <div class="col-md-3 d-flex flex-column align-items-center">
            <div class="profile-pic mb-3" id="profilePreviewEdit" style="background-image: url('<?php echo $tphoto; ?>')"></div>
            <button type="button" class="btn change-photo-btn px-3 py-2" data-bs-toggle="modal" data-bs-target="#changePhotoModal">Change Photo</button>
          </div>

          <!-- Right Column (Editable Details) -->
          <div class="col-md-9">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="profile-label">First Name:</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>" required>
              </div>
              <div class="col-md-6">
                <label class="profile-label">Last Name:</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" required>
              </div>
              
              <div class="col-md-6">
                <label class="profile-label">Gender:</label>
                <select name="gender" class="form-select">
                  <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                  <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                  <option value="Prefer not to say" <?php echo ($gender == 'Prefer not to say') ? 'selected' : ''; ?>>Prefer not to say</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="profile-label">Username:</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
              </div>

              <div class="col-md-6">
                <label class="profile-label">Email Address:</label>
                <input type="email" name="email_address" class="form-control" value="<?php echo $email_address; ?>" required>
              </div>
              <div class="col-md-6">
                <label class="profile-label">Years of Experience in Tutoring:</label>
                <input type="text" name="experience" class="form-control" value="<?php echo $experience; ?>">
              </div>

              <div class="col-md-6">
                <label class="profile-label">Language:</label>
                <input type="text" name="language" class="form-control" value="<?php echo $language; ?>">
              </div>
              <div class="col-md-6">
                <label class="profile-label">Credentials:</label>
                <input type="text" name="credentials" class="form-control" value="<?php echo $photo_credentials; ?>">
              </div>

              <div class="col-md-12">
                <label class="profile-label">About Me:</label>
                <textarea name="about" class="form-control" rows="3"><?php echo $about; ?></textarea>
              </div>

              <div class="col-md-4">
                <label class="profile-label">Gmail Link:</label>
                <input type="text" name="gmail" class="form-control" value="<?php echo $gmail; ?>">
              </div>
              <div class="col-md-4">
                <label class="profile-label">Telegram Link:</label>
                <input type="text" name="telegram" class="form-control" value="<?php echo $telegram; ?>">
              </div>
              <div class="col-md-4">
                <label class="profile-label">Facebook Link:</label>
                <input type="text" name="facebook" class="form-control" value="<?php echo $facebook; ?>">
              </div>
              
              <div class="col-12 mt-4 text-end">
                <button type="button" class="btn btn-secondary me-2" id="cancelEditBtn">Cancel</button>
                <button type="submit" name="save_info" class="btn save-btn">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Change Photo Modal -->
<div class="modal fade" id="changePhotoModal" tabindex="-1" aria-labelledby="changePhotoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePhotoModalLabel">Change Profile Photo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="file" name="profile_pic" class="form-control" accept="image/*" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="upload_photo" class="btn save-btn">Upload Photo</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap and jQuery Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Edit button click
    $("#editInfoBtn").click(function() {
      $("#viewMode").hide();
      $("#editMode").show();
      $(this).hide();
    });
    
    // Cancel button click
    $("#cancelEditBtn").click(function() {
      $("#editMode").hide();
      $("#viewMode").show();
      $("#editInfoBtn").show();
    });
  });
</script>
</body>
</html>