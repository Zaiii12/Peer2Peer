<?php
session_start();


$studentsFile = 'students.json';
$tutorsFile = 'tutors.json';


function loadData($file) {
    if (file_exists($file)) {
        return json_decode(file_get_contents($file), true);
    }
    return [];
}


function saveData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}


$students = loadData($studentsFile);
$tutors = loadData($tutorsFile);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
    header('Location: ?page=dashboard');
    exit();
}


if (isset($_GET['page']) && $_GET['page'] === 'logout') {
    session_destroy();
    header('Location: ?page=login');
    exit();
}


if (!isset($_SESSION['username']) && (isset($_GET['page']) && $_GET['page'] !== 'login')) {
    header('Location: ?page=login');
    exit();
}


$page = isset($_GET['page']) ? $_GET['page'] : 'login';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $page == 'student_request') {
    $new_student = [
        "id" => count($students) + 1,
        "date" => date("m-d-Y"),
        "sr_code" => $_POST['sr_code'],
        "name" => $_POST['name'],
        "gender" => $_POST['gender'],
        "email" => $_POST['email']
    ];
    $students[] = $new_student;
    saveData($studentsFile, $students); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $page == 'tutor_request') {
    $new_tutor = [
        "id" => count($tutors) + 1,
        "date" => date("m-d-Y"),
        "name" => $_POST['name'],
        "gender" => $_POST['gender'],
        "email" => $_POST['email']
    ];
    $tutors[] = $new_tutor;
    saveData($tutorsFile, $tutors);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $page == 'update_profile') {
    $_SESSION['username'] = $_POST['username'];
}


if (isset($_GET['delete_student'])) {
    $studentId = $_GET['delete_student'];
    $students = array_filter($students, function($s) use ($studentId) {
        return $s['id'] != $studentId;
    });
    $students = array_values($students); 
    saveData($studentsFile, $students); 
}

if (isset($_GET['delete_tutor'])) {
    $tutorId = $_GET['delete_tutor'];
    $tutors = array_filter($tutors, function($t) use ($tutorId) {
        return $t['id'] != $tutorId;
    });
    $tutors = array_values($tutors); 
    saveData($tutorsFile, $tutors); 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin System</title>
    <style>
        body { font-family: Arial; }
        .header { display: flex; justify-content: space-between; background: #f2f2f2; padding: 10px; }
        .username { margin-left: 10px; }
        .logout { background: red; color: white; padding: 5px 10px; text-decoration: none; }
        .dashboard { display: flex; flex-wrap: wrap; padding: 20px; gap: 10px; }
        .card { display: block; width: 180px; height: 100px; text-align: center; color: white; text-decoration: none; padding: 10px; }
        .red { background: red; }
        .graph { background: #ddd; height: 200px; flex: 1 1 45%; margin-top: 20px; padding: 10px; text-align: center; }
        table { width: 90%; margin: 20px; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        .approve { background: green; color: white; }
        .reject { background: red; color: white; }
        .nav { margin: 20px; display: flex; gap: 10px; }
        .nav button { padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>

<?php if ($page === 'login'): ?>
    <h2>Login</h2>
    <form method="POST">
        <label>Username: <input type="text" name="username" required></label>
        <button type="submit">Login</button>
    </form>

<?php elseif ($page === 'dashboard'): ?>
    <div class="header">
        <div class="username"><?= $_SESSION['username'] ?></div>
        <a href="?page=logout" class="logout">LOGOUT</a>
    </div>

    <div class="nav">
        <button onclick="window.location.href='?page=dashboard'">Dashboard</button>
        <button onclick="window.location.href='?page=student_request'">Student Request</button>
        <button onclick="window.location.href='?page=tutor_request'">Tutor Request</button>
        <button onclick="window.location.href='?page=update_profile'">Update Profile</button>
    </div>

    <div class="dashboard">
        <a href="?page=student_request" class="card red">
            <div><?= count($students) ?></div>
            <p>Sign Up Request - Student</p>
        </a>
        <a href="?page=tutor_request" class="card red">
            <div><?= count($tutors) ?></div>
            <p>Sign Up Request - Tutor</p>
        </a>
        <a href="#" class="card red">
            <div>0</div>
            <p>All Students</p>
        </a>
        <a href="#" class="card red">
            <div>0</div>
            <p>All Tutors</p>
        </a>
        <div class="graph">Graph for No. of Tutors</div>
        <div class="graph">Graph for No. of Students</div>
    </div>

<?php elseif ($page === 'student_request'): ?>
    <h2>Student Sign-Up Request</h2>
    <form method="POST">
        <label>SR Code: <input type="text" name="sr_code" required></label><br>
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Gender: 
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <button type="submit">Submit</button>
    </form>
    <h3>Existing Requests</h3>
    <table>
        <thead>
            <tr><th>ID</th><th>Date</th><th>Sr-Code</th><th>Name</th><th>Gender</th><th>Email</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php foreach ($students as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= $s['date'] ?></td>
                <td><?= $s['sr_code'] ?></td>
                <td><?= $s['name'] ?></td>
                <td><?= $s['gender'] ?></td>
                <td><?= $s['email'] ?></td>
                <td>
                    <button class="approve">&#x2714;</button>
                    <button class="reject">&#x2716;</button>
                    <a href="?delete_student=<?= $s['id'] ?>" class="reject">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php elseif ($page === 'tutor_request'): ?>
    <h2>Tutor Sign-Up Request</h2>
    <form method="POST">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Gender: 
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <button type="submit">Submit</button>
    </form>
    <h3>Existing Requests</h3>
    <table>
        <thead>
            <tr><th>ID</th><th>Date</th><th>Credentials</th><th>Name</th><th>Gender</th><th>Email</th><th>Action</th></tr>
        </thead>
        <tbody>
            <?php foreach ($tutors as $t): ?>
            <tr>
                <td><?= $t['id'] ?></td>
                <td><?= $t['date'] ?></td>
                <td><a href="#">View</a></td>
                <td><?= $t['name'] ?></td>
                <td><?= $t['gender'] ?></td>
                <td><?= $t['email'] ?></td>
                <td>
                    <button class="approve">&#x2714;</button>
                    <button class="reject">&#x2716;</button>
                    <a href="?delete_tutor=<?= $t['id'] ?>" class="reject">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php elseif ($page === 'update_profile'): ?>
    <h2>Update Profile</h2>
    <form method="POST">
        <label>Username: <input type="text" name="username" value="<?= $_SESSION['username'] ?>" required></label><br>
        <button type="submit">Update</button>
    </form>

<?php endif; ?>

</body>
</html>
