<?php

$userName = "Learner"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tutoring Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f9f9f9;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
        }

        .logo img {
            height: 30px;
            margin-right: 10px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-bar {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .explore-dropdown, .user-dropdown {
            position: relative;
        }

        .explore-dropdown button,
        .user-dropdown span {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 14px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: white;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            padding: 10px;
            top: 100%;
            left: 0;
            min-width: 150px;
            z-index: 10;
        }

        .dropdown-content a {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: black;
        }

        .explore-dropdown:hover .dropdown-content,
        .user-dropdown:hover .dropdown-content {
            display: block;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .lang-toggle {
            border: none;
            background: #eee;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .my-learning {
            text-decoration: none;
            font-weight: bold;
            color: #333;
        }

        main {
            padding: 40px;
            text-align: center;
        }

        .start-btn, .explore-btn {
            margin: 10px;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .start-btn {
            background: #3ba55c;
            color: white;
        }

        .explore-btn {
            border: 2px solid #3ba55c;
            color: #3ba55c;
            background: white;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="logo.png" alt="Tutoring Academy Logo" />
            <span>Tutoring Academy</span>
        </div>
        <nav class="nav">
            <div class="explore-dropdown">
                <button>Explore ▼</button>
                <div class="dropdown-content">
                    <a href="#">Subjects</a>
                    <a href="#">Tutors</a>
                    <a href="#">Workshops</a>
                </div>
            </div>
            <input type="text" class="search-bar" placeholder="Search courses, resources..." />
        </nav>
        <div class="user-section">
            <a href="#" class="my-learning">My Learning</a>
            <button class="lang-toggle">EN</button>
            <div class="user-dropdown">
                <span><?php echo $userName; ?> ▼</span>
                <div class="dropdown-content">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <h1>Welcome, <?php echo $userName; ?>!</h1>
        <p>Start your tutoring journey or explore new subjects today.</p>
        <button class="start-btn">Start Learning</button>
        <button class="explore-btn">Explore Subjects</button>
    </main>
</body>
</html>