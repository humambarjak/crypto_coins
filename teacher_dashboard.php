<?php
session_start();

// Check if the user is logged in and has the "teacher" role
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: login.php");
    exit();
}

include('db.php');
// include('navbar.php'); // Navbar inclusion at the top

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leraar Dashboard</title>
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
        <h1>Welkom, <?php echo $_SESSION['username']; ?> (Leraar)</h1>
        
        <!-- PDF and Image Upload Form -->
        <form action="upload_pdf.php" method="post" enctype="multipart/form-data">

        <label for="bookTitle" class="custom-file-label">Book Title:</label>
<input type="text" id="bookTitle" name="bookTitle" class="input-text" required>

<!-- For PDF file -->
<label for="pdfFile" class="custom-file-label">Selecteer PDF-bestand:</label>
<div class="file-upload-container">
    <div tabindex="0" class="plusButton" onclick="document.getElementById('pdfFile').click();">
        <svg class="plusIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
            <g mask="url(#mask0_21_345)">
                <path d="M13.75 23.75V16.25H6.25V13.75H13.75V6.25H16.25V13.75H23.75V16.25H16.25V23.75H13.75Z"></path>
            </g>
        </svg>
    </div>
    <input type="file" id="pdfFile" name="pdfFile" accept=".pdf" style="display: none;" required onchange="showFileName(this, 'pdf-file-name')">
    <p id="pdf-file-name" class="file-name-label">Geen PDF geselecteerd</p>
</div>

<!-- For Cover Image -->
<label for="coverImage" class="custom-file-label">Selecteer omslagafbeelding:</label>
<div class="file-upload-container">
    <div tabindex="0" class="plusButton" onclick="document.getElementById('coverImage').click();">
        <svg class="plusIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
            <g mask="url(#mask0_21_345)">
                <path d="M13.75 23.75V16.25H6.25V13.75H13.75V6.25H16.25V13.75H23.75V16.25H16.25V23.75H13.75Z"></path>
            </g>
        </svg>
    </div>
    <input type="file" id="coverImage" name="coverImage" accept=".jpg,.jpeg,.png" style="display: none;" required onchange="showFileName(this, 'cover-file-name')">
    <p id="cover-file-name" class="file-name-label">Geen omslagafbeelding geselecteerd</p>
</div>

            <!-- Submit Button -->
<button type="submit" class="btn-submit">Upload Book</button>
        </form>


        <!-- Add buttons for Quiz and Logout -->
        <div style="margin-top: 20px;">
            <!-- <button onclick="window.location.href='quiz.php';" style="margin-right: 10px;">Ga naar Quiz</button> -->
            <button onclick="window.location.href='logout.php';">Uitloggen</button>
        </div>
    </div>
    
</body>
</html>
