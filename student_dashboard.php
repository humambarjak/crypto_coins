<?php
session_start();

// Check if the user is logged in and has the "student" role
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

include('db.php');
// include('navbar.php'); // Navbar inclusion at the top

// Check if the selected book has been set by the teacher
$selected_book = isset($_SESSION['selected_book']) ? $_SESSION['selected_book'] : "Geen boek geselecteerd"; // Default message if no book is selected

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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
        <h1>Welkom, <?php echo $_SESSION['username']; ?> (Student)</h1>
        
        <h2>Beschikbare boeken:</h2>
        <p>Huidige boek gekozen door de leraar: <?php echo $selected_book; ?></p>

        <!-- Book list displayed as cards -->
        <div class="book-list">
            <?php
            // Show books added by any teacher and make them clickable
            $sql = "SELECT * FROM books";
            $result = $conn->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                echo "<div class='book-card'>";
                // Make the book cover clickable, redirecting to the quiz page with book_id
                echo "<a href='quiz.php?book_id=" . urlencode($row['id']) . "'>";
                if (!empty($row['image_path'])) {
                    echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Book Cover' class='book-cover'>";
                }
                echo "</a>"; // Closing the link tag

                echo "<div class='book-info'>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p>Toegevoegd door: " . htmlspecialchars($row['teacher']) . "</p>";
                echo "<a href='" . htmlspecialchars($row['pdf_path']) . "' download class='download-link'>Download PDF</a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>

        <!-- Button to log out -->
        <div class="dashboard-actions">
            <button onclick="window.location.href='logout.php';" class="logout-button">Uitloggen</button>
        </div>
    </div>
</body>
</html>