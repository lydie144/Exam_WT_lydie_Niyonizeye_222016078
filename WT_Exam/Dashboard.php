<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not, redirect to the login page
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/track.jpeg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        nav {
            width: 200px;
            background-color: rgba(0, 0, 0, 0.8);
            padding-top: 20px;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
        }

        nav a, .dropdown .dropbtn {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            text-align: left;
        }

        nav a:hover, .dropdown:hover .dropbtn {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: relative;
            background-color: rgba(0, 0, 0, 0.8);
            min-width: 200px;
        }

        .dropdown-content a {
            padding: 10px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .options {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .options .dropdown-content {
            right: 0;
            left: auto;
        }

        main {
            margin-left: 220px;
            padding: 20px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        section {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Time Tracking Application Website</h1>
    </header>
    <nav>
        <a href="#">Home</a>
        <div class="dropdown">
            <a href="#" class="dropbtn">Form</a>
            <div class="dropdown-content">
                <a href="attendanceForm.html">ATTENDANCE</a>
                <a href="billingRatesForm.html">BILLING RATES</a>
                <a href="clientsForm.html">CLIENTS</a>
                <a href="holidaysForm.php">HOLIDAYS</a>
                <a href="projectsForm.php">PROJECTS</a>
                <a href="reportsForm.php">REPORTS</a>
                <a href="tasksForm.html">TASKS</a>
                <a href="timesheet.php">TIME SHEET</a>
                <a href="add_time_entry.php">TIME ENTRIES</a>
            </div>
        </div>
        
        <div class="dropdown">
            <a href="#" class="dropbtn">Tables</a>
            <div class="dropdown-content">
                <a href="viewattendance.php">ATTENDANCE</a>
                <a href="viewbillingrates.php">BILLING RATES</a>
                <a href="viewclients.php">CLIENTS</a>
                <a href="viewholidays.php">HOLIDAYS</a>
                <a href="viewprojects.php">PROJECTS</a>
                <a href="viewreports.php">REPORTS</a>
                <a href="viewtasks.php">TASKS</a>
                <a href="viewtimesheet.php">TIME SHEET</a>
                <a href="viewtime_entries.php">TIME ENTRIES</a>
                <a href="viewusers.php">USERS</a>
            </div>
        </div>
        <a href="About Us.html">About Us</a>
        <a href="contact Us.html">Contact Us</a>
    </nav>
    <div class="options">
        <div class="dropdown">
            <a href="#" class="dropbtn">Options</a>
            <div class="dropdown-content">
                <a href="register.html">Register</a>
                <a href="login.html">Log in</a>
                <a href="logout.php">Log out</a>
            </div>
        </div>
    </div>
    <main>
        <section>
            <h2>Welcome to our Time Tracking Application</h2>
            <p>Our Time Tracking Application is designed to help individuals and businesses efficiently manage their time-related tasks and projects. With intuitive features and user-friendly interfaces, our application makes time tracking and project management a breeze.</p>
            <p>Whether you're a freelancer managing multiple projects or a business owner overseeing a team, our application offers comprehensive tools to streamline your workflow. From tracking billable hours to generating detailed reports, we've got you covered.</p>
            <p>Key features include:</p>
            <ul>
                <li>User Management: Easily add, edit, and remove users to ensure seamless collaboration.</li>
                <li>Project Tracking: Keep track of project progress, deadlines, and milestones with our project management tools.</li>
                <li>Time Entries: Log and categorize time entries to accurately measure productivity and billable hours.</li>
                <li>Reporting: Generate custom reports to gain insights into time usage, project costs, and team performance.</li>
                <li>Customization: Tailor the application to your specific needs with customizable settings and preferences.</li>
            </ul>
            <p>Experience the convenience and efficiency of our Time Tracking Application today!</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024@ Tracking Time Application, Designed by Niyonizeye lydie.</p>
    </footer>
</body>
</html>
