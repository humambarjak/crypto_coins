<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check the user role to redirect accordingly
if ($_SESSION['role'] == 'student') {
    header("Location: student_dashboard.php");
    exit();
} elseif ($_SESSION['role'] == 'teacher') {
    header("Location: teacher_dashboard.php");
    exit();
}
?>

// Fetch the selected book from the session
$selected_book = isset($_SESSION['selected_book']) ? $_SESSION['selected_book'] : "Geen boek geselecteerd";
?>
?>

!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar and Header -->
<div id="navbar">
    <?php include('navbar.php'); ?>
</div>

<!-- Dynamic Content Area -->
<div id="content">
    <!-- Initial content goes here or via AJAX -->
</div>

<div id="loadingSpinner" class="spinner-container">
    <div class="spinner"></div>
</div>
    <div class="dashboard-container">
        <h1>Welkom, <?php echo $_SESSION['username']; ?></h1>

        <!-- Display the selected book -->
        <h2>Geselecteerd boek: <?php echo $selected_book; ?></h2>
        
        <p><a href="logout.php">Uitloggen</a></p>

    </div>
    
</body>
</html>